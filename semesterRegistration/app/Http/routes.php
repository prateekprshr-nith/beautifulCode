<?php

/*
 * This file contains all the routes for the application
 */


Route::group(['middleware' => 'web'], function () {

    // Landing page
    Route::get('/', function () {
        return view('welcome');
    })->middleware('guest:student');

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
    Route::get('/students/home', 'Student\HomeController@index');
});
