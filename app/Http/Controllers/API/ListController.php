<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Base\BaseController;
use App\Models\Activities;
use App\Models\Lists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mavinoo\Batch\BatchFacade;
use phpDocumentor\Reflection\Types\Integer;
use PhpParser\Node\Expr\Cast\Int_;

class ListController extends BaseController
{

    public function getData($listId){
        //Comprobamos que el usuario tenga acceso a la lista de la actividad
        if(!$list = auth('api')->user()->lists()->with('activities')->withCount([
            'activities',
            'activitiesPending',
            'activitiesCompleted'
        ])->find($listId)){
            return response('',403);
        }
        return response($list);
    }

    public function get(){
        $lists = auth('api')->user()->lists()->withCount([
            'activities',
            'activitiesPending',
            'activitiesCompleted'
        ])->orderBy('priority')->get();
        return response($lists->toArray(), 200);
    }

    public function modifyActivitiesOrder(Request $request, $listId){
        //Validamos
        $validator = Validator::make($request->all(), [
            'data' => 'required|array',
            'data.*' => 'required|integer',
        ]);
        if($validator->fails()) {
            return response($validator->errors(), 400);
        }

        //Comprobamos que el usuario tenga acceso a la lista de la actividad
        if(!$list = auth('api')->user()->lists()->find($listId)){
            return response('',403);
        }

        $newOrderArray = $request->input('data');
        $updated = $this->updateActivitiesOrder($list, $newOrderArray);
        //Devolvemos mod correcta
        return response($updated, 200);
    }

    private function updateActivitiesOrder(Lists $list, array $newOrder){
        $activities = $list->activities(false)->findMany($newOrder);
        $iPriority = 1;
        $updateAttributes = [];
        foreach ($newOrder as $activityId){
            if($activity = $activities->find($activityId)){
                if($activity->listPriority !== $iPriority){
                    array_push($updateAttributes, [
                        'id' => $activityId,
                        'listPriority' => $iPriority
                    ]);
                }
                $iPriority++;
            }
        }
        return BatchFacade::update(new Activities(), $updateAttributes, 'id');

    }



    public function modifyOrder(Request $request){
        //Validamos
        $validator = Validator::make($request->all(), [
            'data' => 'required|array',
            'data.*' => 'required|integer',
        ]);
        if($validator->fails()) {
            return response($validator->errors(), 400);
        }

        $newOrderArray = $request->input('data');
        $updated = $this->updateOrder($newOrderArray);
        return response($updated, 200);
    }

    private function updateOrder(array $newOrder){
        $lists = auth('api')->user()->lists()->findMany($newOrder);
        $iPriority = 1;
        $updateAttributes = [];
        foreach ($newOrder as $listId){
            if($list = $lists->find($listId)){
                if($list->priority !== $iPriority){
                    array_push($updateAttributes, [
                        'id' => $listId,
                        'priority' => $iPriority
                    ]);
                }
                $iPriority++;
            }
        }
        return BatchFacade::update(new Lists(), $updateAttributes, 'id');
    }

    public function create(Request $request){
        //Validamos
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'string|nullable',
            'private' => 'boolean',
        ]);
        if($validator->fails()) {
            return response($validator->errors(), 400);
        }

        $list = new Lists();
        $list->name = $request->input('name');
        $list->description = $request->input('description')?? '';
        $list->user_id = auth()->id();
        $list->private = $request->input('private', false);
        $list->saveOrFail();
        $list->syncOriginal();

        //Devolvemos mod correcta
        return response($list->toArray(), 200);
    }

    public function delete($listId){
        //Comprobamos que el usuario tenga acceso a la lista de la actividad
        if(!$list = auth('api')->user()->lists()->find($listId)){
            return response('',403);
        }
        $list->delete();
        //Devolvemos mod correcta
        return response('', 200);
    }

    public function update(Request $request, $listId){
        //Comprobamos que el usuario tenga acceso a la lista de la actividad
        /** @var Lists $list */
        if(!$list = auth('api')->user()->lists()->find($listId)){
            return response('',403);
        }

        $attributes = array_intersect_key($request->all(), array_flip(['name', 'description', 'todo', 'private']));
        if(array_key_exists('description', $attributes) && $attributes['description'] === null){
            $attributes['description'] = '';
        }
        $list->setRawAttributes($attributes);
        $list->saveOrFail();

        return response(Lists::find($listId)->toArray());
    }

    public function copy($listId){
        //Check if the list if from the user or its public. If not fails
        $findQuery = Lists::query();
        $findQuery->orWhere(function ($query) {
            $query->where('user_id', auth()->id())
                ->orWhere('private', false);
        });
        /** @var Lists $original */
        $original = $findQuery->findOrFail($listId);
        $newList = $original->replicate([
            'id',
            'priority',
            'user_id'
        ])
            ->setAttribute('user_id', auth()->id())
            ->setAttribute('name', $original->getAttribute('name') . ' Copy');

        try {
            $newList->saveOrFail();
        } catch (\Throwable $e) {
            return response('Failed to Clone', 500);
        }

        /** @var Activities $act */
        foreach ($original->activities()->get() as $act){
            $act->replicate([
                'listPriority',
                'list_id'
            ])->setAttribute('list_id', $newList->getAttribute('id'))->save();
        }
        return response($newList->refresh()->toArray());
    }


    public function randomizeListOrder(int $listId){
        //Comprobamos que el usuario tenga acceso a la lista de la actividad
        /** @var Lists $list */
        if(!$list = auth('api')->user()->lists()->find($listId)){
            return response('',403);
        }
        $activities = $list->activities(false)->inRandomOrder()->get(['id'])->toArray();
        $newOrderIds = array_column($activities, 'id');
        $updated = $this->updateActivitiesOrder($list, $newOrderIds);
        return response($updated, 200);
    }

}
