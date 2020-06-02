<?php


namespace App\Http\Controllers;


use Illuminate\Support\Facades\File;

class WelcomeController extends Controller
{

    public function __invoke()
    {
        return view('welcome');
    }

}
