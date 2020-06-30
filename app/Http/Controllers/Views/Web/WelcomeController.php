<?php


namespace App\Http\Controllers\Views\Web;


use App\Http\Controllers\Base\BaseController;
use App\Models\History\ListViewHistory;
use App\Models\Lists;
use App\User;

class WelcomeController extends BaseController
{

    public function __invoke()
    {
        return view('web_1.welcome');
    }

}
