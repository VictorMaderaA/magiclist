<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => 'auth:api',
    'namespace' => 'API'
], function ($router) {


    Route::group([
        'prefix' => 'auth',
    ], function ($router) {
        Route::post('login', 'AuthController@login')->name('api_login');
        Route::post('logout', 'AuthController@logout')->name('api_logout');
        Route::post('refresh', 'AuthController@refresh')->name('api_refresh');
        Route::post('me', 'AuthController@me')->name('api_me');
    });

    Route::post('/activity/{activityId}/change-completed-state', 'ActivitiesController@changeCompletedState');
    Route::post('/list/{listId}/change-activities-order', 'ListController@modifyActivitiesOrder');
    Route::post('/list/change-order', 'ListController@modifyOrder');
    Route::post('/list', 'ListController@create');
    Route::get('/list/{listId}', 'ListController@getData');
    Route::post('/activity', 'ActivitiesController@create');


});


