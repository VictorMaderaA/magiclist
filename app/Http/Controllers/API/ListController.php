<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Base\BaseController;
use App\Models\Activities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mavinoo\Batch\BatchFacade;

class ListController extends BaseController
{

    public function modifyActivitiesOrder(Request $request, $listId){
        //Validamos
        $validator = Validator::make($request->all(), [
            'data' => 'required|array',
            'data.*' => 'required|integer',
        ]);
        if($validator->fails()) {
            return response($validator->errors(), 404);
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

}
