<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('dev/views/', 'Views\Develop\ViewsController@index');
Route::get('dev/views/{id}', 'Views\Develop\ViewsController@show')->name('dev_views_show');


Route::get('/', 'WelcomeController');

Auth::routes(['verify' => true]);

Route::get('/legal/terms', "Views\Web\LegalController@terms")->name('legal_terms');
Route::get('/legal/privacy', "Views\Web\LegalController@privacy")->name('legal_privacy');
Route::get('/legal/cookies', "Views\Web\LegalController@cookies")->name('legal_cookies');


Route::get('/app', 'HomeController@index')->name('home');
Route::get('/contact', 'Views\Web\ContactController@index')->name('contact');

Route::get('/list/{listId}', 'Views\Web\ListController@index')->name('list_index');




//Route::get('image-upload', 'ImageUploadController@imageUpload')->name('image.upload');
//Route::post('image-upload', 'ImageUploadController@imageUploadPost')->name('image.upload.post');
