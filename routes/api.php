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

Route::post('auth/login', 'API\AuthController@login')->name('api_login');

Route::group([
    'middleware' => 'auth:api',
    'namespace' => 'API'
], function ($router) {


    Route::group([
        'prefix' => 'auth',
    ], function ($router) {
        Route::post('logout', 'AuthController@logout')->name('api_logout');
        Route::post('refresh', 'AuthController@refresh')->name('api_refresh');
        Route::post('me', 'AuthController@me')->name('api_me');
    });

    Route::post('/activity/{activityId}/change-completed-state', 'ActivitiesController@changeCompletedState');
    Route::post('/list/{listId}/change-activities-order', 'ListController@modifyActivitiesOrder');
    Route::post('/list/{listId}/randomize-activities-order', 'ListController@randomizeListOrder');
    Route::post('/list/change-order', 'ListController@modifyOrder');
    Route::post('/list', 'ListController@create');
    Route::get('/list/{listId}', 'ListController@getData');
    Route::delete('/list/{listId}', 'ListController@delete');
    Route::post('/list/{listId}', 'ListController@update');
    Route::get('/list', 'ListController@get');
    Route::get('/activity/{activityId}', 'ActivitiesController@getData');
    Route::delete('/activity/{activityId}', 'ActivitiesController@delete');
    Route::post('/activity/{activityId}', 'ActivitiesController@update');
    Route::post('/activity/{activityId}/media', 'ActivitiesController@addMediaFile');
    Route::post('/activity', 'ActivitiesController@create');
    Route::post('/list/{listId}/copy', 'ListController@copy');

    Route::post('/contact', 'FeedbackController@sendMessage')->name('api_contact');
});

Route::get('/list/explore', 'API\ListController@explore')->middleware('guest');



