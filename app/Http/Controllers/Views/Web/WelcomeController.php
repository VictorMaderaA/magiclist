<?php


namespace App\Http\Controllers\Views\Web;


use App\Http\Controllers\Base\BaseController;

class WelcomeController extends BaseController
{

    public function __invoke()
    {
        return view('web_1.welcome');
    }

}
