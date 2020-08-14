<?php

use Illuminate\Http\Request;
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
Route::group(['namespace' => 'Api'], function() {

    // Authentication routes for login / register.
    Route::group(['namespace' => 'Auth'], function() {
        Route::post('/login', "LoginController@login");
        Route::post('/register', "LoginController@register");
    });

    // Admin routes works only for admin users.
    Route::group(['namespace' => 'Admin', 'middleware' => 'admin'], function() {

        // Manage users.
        Route::get('/users', "UserAdminController@index");
        Route::get('/users/{user}', "UserAdminController@show");
        Route::post('/users', "UserAdminController@store");
        Route::put('/users/{user}', "UserAdminController@update");
        Route::delete('/users/{user}', "UserAdminController@destroy");

    });
});
