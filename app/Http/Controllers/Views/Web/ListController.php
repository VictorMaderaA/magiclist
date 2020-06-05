<?php


namespace App\Http\Controllers\Views\Web;


use App\Http\Controllers\Base\BaseController;
use App\Models\Lists;

class ListController extends BaseController
{

    public function __construct()
    {
        self::middleware('api');
    }

    public function index($listId)
    {
        $list = Lists::query()
            ->where('user_id', auth('web')->id())
            ->with('activities')
            ->findOrFail($listId);
        return view('web.list.index')
            ->with('list', json_encode($list->toArray(), 1));
    }

}
