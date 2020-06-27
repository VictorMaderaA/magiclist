<?php

namespace App\Http\Controllers\Views\Web;

use App\Http\Controllers\Base\BaseController;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('web_1.home');
    }
}
