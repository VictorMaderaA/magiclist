<?php


namespace App\Http\Controllers\Views\Web;


use App\Http\Controllers\Base\BaseController;
use App\Models\Lists;

class ListController extends BaseController
{

    public function explore()
    {
        $lists = Lists::query()->where('private', false)->get(['id', 'name', 'description']);
        return view('web_1.lists')
            ->with('lists', $lists);
    }

}
