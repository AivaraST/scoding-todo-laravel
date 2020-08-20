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

// Authentication
Route::group(['namespace' => 'Api\Auth', 'prefix' => 'auth', 'middleware' => 'api'], function($router) {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');

    Route::group(['middleware' => 'jwt.verify'], function ($router) {
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::get('user', "AuthController@user");
    });
});

// User tasks
Route::group(['namespace' => 'Api', 'prefix' => 'dashboard', 'middleware' => ['api', 'jwt.verify']], function() {
    Route::get('tasks', "TaskController@index");
    Route::put('tasks/{task}', "TaskController@update")->middleware('user.task');
});

// Admin actions
Route::group(['namespace' => 'Api\Admin', 'prefix' => 'admin', 'middleware' => ['api', 'jwt.verify', 'admin']], function() {

    // Manage users
    Route::get('/users', "AdminUserController@index");
    Route::get('/users/{user}', "AdminUserController@show");
    Route::post('/users', "AdminUserController@store");
    Route::put('/users/{user}', "AdminUserController@update");
    Route::delete('/users/{user}', "AdminUserController@destroy");

    // Manage user tasks
    Route::get('user/{user}/tasks', "AdminTaskController@index");
    Route::get('tasks/{task}', "AdminTaskController@show");
    Route::post('user/{user}/tasks', "AdminTaskController@store");
    Route::put('tasks/{task}', "AdminTaskController@update");
    Route::delete('tasks/{task}', "AdminTaskController@destroy");
});
