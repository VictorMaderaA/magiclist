<?php


namespace App\Http\Controllers\Views\Web;


use App\Http\Controllers\Base\BaseController;
use App\Models\Activities;
use App\Models\History\ListViewHistory;
use App\Models\Lists;
use App\User;
use Illuminate\Support\Facades\Auth;

class ExploreController extends BaseController
{

    public function index(){
        $lists = Lists::query()->where('private', false)->limit(50)->get(['id', 'name', 'description']);
        return view('web_1.explore.index')
            ->with('lists', $lists);
    }

    public function list($listId){
        $list = Lists::query()->where('private', false)->with('activities')->findOrFail($listId);
        ListViewHistory::createNew($list, User::find(\auth()->id()), request()->ip());
        return view('web_1.explore.list')
            ->with('list', $list);
    }

    public function activity($activityId){
        $activity = Activities::query()->findOrFail($activityId);
        Lists::query()->where('private', false)->findOrFail($activity->list_id);
        return view('web_1.explore.activity')
            ->with('activity', $activity);
    }

}
