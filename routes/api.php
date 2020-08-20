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
    Route::get('tasks/{sortName?}/{sortType?}', "TaskController@index");
    Route::put('tasks/{task}', "TaskController@update")->middleware('user.task');
});



// Authentication routes.
//Route::group(['namespace' => 'Api\Auth', 'prefix' => 'auth'], function() {
//    Route::post('/login', ['as' => 'login', 'uses' => 'AuthController@login']);
//    Route::post('/register', "AuthController@register");
//        Route::get('/user', "AuthController@user")->middleware('jwt.auth');
//});

//Route::group([
//
//    'namespace' => 'Api\Auth',
//    'middleware' => 'api',
//    'prefix' => 'auth'
//
//], function ($router) {
//
//    Route::post('login', 'AuthController@login');
//    Route::post('logout', 'AuthController@logout');
//    Route::post('refresh', 'AuthController@refresh');
//    Route::post('me', 'AuthController@me');
//
//});

//Route::group(['namespace' => 'Api'], function() {
//    // Admin routes works only for admin users.
//    Route::group(['namespace' => 'Admin', 'middleware' => ['jwt.auth', 'admin'], 'prefix' => 'admin'], function() {
//
//        // Manage users.
//        Route::get('/users', "UserAdminController@index");
//        Route::get('/users/{user}', "UserAdminController@show");
//        Route::post('/users', "UserAdminController@store");
//        Route::put('/users/{user}', "UserAdminController@update");
//        Route::delete('/users/{user}', "UserAdminController@destroy");
//
//        // Manage user tasks.
//        Route::get('user/{user}/tasks', "TaskAdminController@index");
//        Route::get('tasks/{task}', "TaskAdminController@show");
//        Route::post('user/{user}/tasks', "TaskAdminController@store");
//        Route::put('tasks/{task}', "TaskAdminController@update");
//        Route::delete('tasks/{task}', "TaskAdminController@destroy");
//
//    });
//
//    // User routes (dashboard)
//    Route::group(['prefix' => 'dashboard', 'middleware' => 'auth:api'], function() {
//        Route::post('tasks/{sortName?}/{sortType?}', "TaskController@index");
//        Route::put('tasks/{task}', "TaskController@update");
//    });
//});
