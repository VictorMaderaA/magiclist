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

//Route::get('test', 'API\ListController@randomizeListOrder');

Route::get('dev/views/', 'Views\Develop\ViewsController@index');
Route::get('dev/views/{id}', 'Views\Develop\ViewsController@show')->name('dev_views_show');


Route::get('/', 'Views\Web\WelcomeController')->name('welcome');

Auth::routes(['verify' => true]);

Route::get('/legal/terms', "Views\Web\LegalController@terms")->name('legal_terms');
Route::get('/legal/privacy', "Views\Web\LegalController@privacy")->name('legal_privacy');
Route::get('/legal/cookies', "Views\Web\LegalController@cookies")->name('legal_cookies');


Route::get('/app', 'Views\Web\HomeController@index')->name('home');
Route::get('/contact', 'Views\Web\FeedbackController@index')->name('contact');

Route::get('/explore', 'Views\Web\ExploreController@index')->name('explore');
Route::get('/explore/list/{listId}', 'Views\Web\ExploreController@list')->name('explore_list');
Route::get('/explore/item/{activityId}', 'Views\Web\ExploreController@activity')->name('explore_activity');
