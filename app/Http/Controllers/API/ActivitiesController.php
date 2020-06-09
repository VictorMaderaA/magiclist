<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Base\BaseController;
use App\Managers\ImageManager;
use App\Models\Activities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ActivitiesController extends BaseController
{

    public function __construct()
    {
        self::middleware('optimizeImages');
    }

    public function getData($activityId)
    {
        //Buscamos que exista la actividad
        $activity = Activities::query()->with('media:id,name,path,mimeType')->findOrFail($activityId);
        //Comprobamos que el usuario tenga acceso a la lista de la actividad
        if (!auth('api')->user()->lists()->find($activity->list_id)) {
            return response('', 403);
        }

        foreach ($activity->media as $m){
            $m->append('temp_url');
        }

        return response($activity, 200);
    }

    public function changeCompletedState(Request $request, $activityId)
    {
        //Validamos
        $validator = Validator::make($request->all(), [
            'state' => 'required|boolean',
        ]);
        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }

        //Buscamos que exista la actividad
        $activity = Activities::query()->findOrFail($activityId);
        //Comprobamos que el usuario tenga acceso a la lista de la actividad
        if (!auth('api')->user()->lists()->find($activity->list_id)) {
            return response('', 403);
        }
        //Modificamos la actividad con el valor correspondiente
        $activity->completed_at = $request->input('state') ? date('Y-m-d H:i:s', now()->getTimestamp()) : null;
        try {
            $activity->saveOrFail();
        } catch (\Exception $e) {
            return response('', 500);
        }

        //Devolvemos mod correcta
        return response($activity->toArray(), 200);
    }

    public function create(Request $request)
    {
        //Validamos
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'string',
            'listId' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }

        $activity = new Activities();
        $activity->name = $request->input('name');
        $activity->description = $request->input('description', '');
        $activity->list_id = $request->input('listId');
        $activity->saveOrFail();
        $activity->syncOriginal();

        //Devolvemos mod correcta
        return response($activity->toArray(), 200);
    }

    public function addMediaFile(Request $request, $activityId)
    {
        //Validamos
        $validator = Validator::make($request->all(), [
            'files.*' => 'required|mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime,image/bmp,image/gif,image/jpeg,image/png,image/webp',
        ]);
        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }


        //Buscamos que exista la actividad
        $activity = Activities::query()->findOrFail($activityId);
        //Comprobamos que el usuario tenga acceso a la lista de la actividad
        if (!auth('api')->user()->lists()->find($activity->list_id)) {
            return response('', 403);
        }

        $imgManager = new ImageManager();
        $uploadedFiles = [];
        $files = $request->file('files');
        foreach ($files as $file) {
            $savedFile = $imgManager->uploadImage($file);
            $activity->media()->save($savedFile);
            $savedFile->append('temp_url');
            array_push($uploadedFiles, $savedFile->toArray());
        }
        return response($uploadedFiles, 200);
    }



    public function update(Request $request, $activityId)
    {
        //Validamos
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'string',
            'listId' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }

        //Buscamos que exista la actividad
        $activity = Activities::query()->findOrFail($activityId);
        //Comprobamos que el usuario tenga acceso a la lista de la actividad
        if (!auth('api')->user()->lists()->find($activity->list_id)) {
            return response('', 403);
        }

        $activity->name = $request->input('name');
        $activity->description = $request->input('description', '');
        $activity->list_id = $request->input('listId');
        $activity->saveOrFail();
        $activity->syncOriginal();
        return response($activity->toArray());
    }

}
