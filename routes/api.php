<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

    Route::patch('category/{id}', 'API\CategoryController@restore');
    Route::resource('category', 'API\CategoryController');

    Route::group([
        'middleware' => ['auth:api', 'cors']
    ], function () {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');

        // Route::patch('category/{id}', 'API\CategoryController@restore');
        // Route::resource('category', 'API\CategoryController');

        Route::patch('place/{id}', 'API\PlaceController@restore');
        Route::resource('place', 'API\PlaceController');

        Route::resource('recomendation', 'API\RecommendationController');
    });
});
