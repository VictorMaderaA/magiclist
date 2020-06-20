<?php


namespace App\Http\Controllers\Views\Web;


use App\Http\Controllers\Base\BaseController;

class FeedbackController extends BaseController
{

    public function __construct()
    {
        self::middleware('auth:api');
    }

    public function index(){
        return view('web_1.contact');
    }

}
