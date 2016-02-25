<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {

    // Landing page
    Route::get('/', function () {
        return view('welcome');
    })->middleware('guest');

    //Student auth routes
    Route::get('/students/login', 'Student\Auth\AuthController@showLoginForm');
    Route::post('/students/login', 'Student\Auth\AuthController@login');
    Route::get('/students/logout', 'Student\Auth\AuthController@logout');
    Route::post('/students/password/email', 'Student\Auth\PasswordController@sendResetLinkEmail');
    Route::post('/students/password/reset', 'Student\Auth\PasswordController@reset');
    Route::get('/students/password/reset/{token?}', 'Student\Auth\PasswordController@showResetForm');
    Route::post('/students/register', 'Student\Auth\AuthController@register');
    Route::get('/students/register', 'Student\Auth\AuthController@showRegistrationForm');

    // Student view routes
    Route::get('/students/home', 'HomeController@index');
});
