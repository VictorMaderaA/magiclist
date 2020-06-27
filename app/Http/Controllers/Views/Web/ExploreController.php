<?php


namespace App\Http\Controllers\Views\Web;


use App\Http\Controllers\Base\BaseController;
use App\Models\Activities;
use App\Models\Lists;

class ExploreController extends BaseController
{

    public function index(){
        $lists = Lists::query()->where('private', false)->limit(50)->get(['id', 'name', 'description']);
        return view('web_1.explore.index')
            ->with('lists', $lists);
    }

    public function list($listId){
        $lists = Lists::query()->where('private', false)->with('activities')->findOrFail($listId);
        return view('web_1.explore.list')
            ->with('list', $lists);
    }

    public function activity($activityId){
        $activity = Activities::query()->findOrFail($activityId);
        Lists::query()->where('private', false)->findOrFail($activity->list_id);
        return view('web_1.explore.activity')
            ->with('activity', $activity);
    }

}
