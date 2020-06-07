<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Base\BaseController;
use App\Models\Activities;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ActivitiesController extends BaseController
{

    public function getData($activityId)
    {
        //Buscamos que exista la actividad
        $activity = Activities::query()->findOrFail($activityId);
        //Comprobamos que el usuario tenga acceso a la lista de la actividad
        if(!auth('api')->user()->lists()->find($activity->list_id)){
            return response('',403);
        }

        return response($activity, 200);
    }

    public function changeCompletedState(Request $request, $activityId)
    {
        //Validamos
        $validator = Validator::make($request->all(), [
            'state' => 'required|boolean',
        ]);
        if($validator->fails()) {
            return response($validator->errors(), 404);
        }

        //Buscamos que exista la actividad
        $activity = Activities::query()->findOrFail($activityId);
        //Comprobamos que el usuario tenga acceso a la lista de la actividad
        if(!auth('api')->user()->lists()->find($activity->list_id)){
            return response('',403);
        }
        //Modificamos la actividad con el valor correspondiente
        $activity->completed_at = $request->input('state')? date('Y-m-d H:i:s', now()->getTimestamp()) : null;
        try {
            $activity->saveOrFail();
        }catch (\Exception $e){
            return response('', 500);
        }

        //Devolvemos mod correcta
        return response($activity->toArray(), 200);
    }

    public function create(Request $request){
        //Validamos
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'string',
            'listId' => 'required|integer'
        ]);
        if($validator->fails()) {
            return response($validator->errors(), 404);
        }

        $activity = new Activities();
        $activity->name = $request->input('name');
        $activity->description = $request->input('description')?? '';
        $activity->list_id = $request->input('listId');
        $activity->saveOrFail();
        $activity->syncOriginal();

        //Devolvemos mod correcta
        return response($activity->toArray(), 200);
    }

}
