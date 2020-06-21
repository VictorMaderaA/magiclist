<?php


namespace App\Http\Controllers\Views\Web;


use App\Http\Controllers\Base\BaseController;

class LegalController extends BaseController
{

    public function terms(){
        return view('web_1.legal.terms');
    }

    public function privacy(){
        return view('web_1.legal.privacy');
    }

    public function cookies(){
        return view('web_1.legal.cookies');
    }
}
