<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Base\BaseController;
use App\Models\Activities;
use App\Models\Lists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mavinoo\Batch\BatchFacade;

class ListController extends BaseController
{

    public function getData($listId){
        //Comprobamos que el usuario tenga acceso a la lista de la actividad
        if(!$list = auth('api')->user()->lists()->with('activities')->find($listId)){
            return response('',403);
        }
        return response($list);
    }

    public function get(){
        $lists = auth('api')->user()->lists()->orderBy('priority')->get();
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
        $activities = $list->activities()->findMany($newOrderArray);
        $iPriority = 1;
        $updateAttributes = [];
        foreach ($newOrderArray as $activityId){
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

        $updated = BatchFacade::update(new Activities(), $updateAttributes, 'id');

        //Devolvemos mod correcta
        return response($updated, 200);
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
        $lists = auth('api')->user()->lists()->findMany($newOrderArray);
        $iPriority = 1;
        $updateAttributes = [];
        foreach ($newOrderArray as $listId){
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

        $updated = BatchFacade::update(new Lists(), $updateAttributes, 'id');

        //Devolvemos mod correcta
        return response($updated, 200);
    }

    public function create(Request $request){
        //Validamos
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'string',
        ]);
        if($validator->fails()) {
            return response($validator->errors(), 400);
        }

        $list = new Lists();
        $list->name = $request->input('name');
        $list->description = $request->input('description', '');
        $list->user_id = auth()->id();
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
        if(!$list = auth('api')->user()->lists()->find($listId)){
            return response('',403);
        }

        if($list instanceof Lists)

        $attributes = array_intersect_key($request->all(), array_flip(['name', 'description']));
        $list->setRawAttributes($attributes);
        $list->saveOrFail();
        $list->syncOriginal();

        return response($list->toArray());
    }

}
