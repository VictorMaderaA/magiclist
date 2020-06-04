<?php


namespace App\Http\Controllers\Views\Web;


use App\Http\Controllers\Base\BaseController;
use App\Models\Lists;

class ListController extends BaseController
{

    public function __construct()
    {
        self::middleware('auth');
    }

    public function index($listId)
    {
        $list = Lists::query()
            ->where('user_id', auth()->id())
            ->findOrFail($listId)->with('activities')->first();
        return view('web.list.index')
            ->with('list', json_encode($list->toArray(), 1));
    }

}
