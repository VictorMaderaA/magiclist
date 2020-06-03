<?php


namespace App\Http\Controllers;


use App\Http\Controllers\Base\BaseController;
use App\Managers\ImageManager;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ImageUploadController extends BaseController
{

    public function __construct()
    {
        self::middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function imageUpload()
    {
        return view('imageUpload');
    }

    /**
     * Display a listing of the resource.
     *
     * @return RedirectResponse
     */
    public function imageUploadPost()
    {
        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        (new ImageManager())->uploadImage(request()->image);

        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $imageName);
        return back()
            ->with('success','You have successfully upload image.')
            ->with('image',$imageName);
    }

}
