<?php

/*
 * This file contains all the routes for the application
 */


Route::group(['middleware' => 'web'], function () {

    // Landing page
    Route::get('/', function () {
        return view('welcome');
    })->middleware('home');

    // Student route group
    Route::group(['prefix' => '/students'], function () {

        //Student auth routes
        Route::get('login', 'Student\Auth\AuthController@showLoginForm')->middleware('home');
        Route::post('login', 'Student\Auth\AuthController@login');
        Route::get('logout', 'Student\Auth\AuthController@logout');
        Route::post('password/email', 'Student\Auth\PasswordController@sendResetLinkEmail');
        Route::post('password/reset', 'Student\Auth\PasswordController@reset');
        Route::get('password/reset/{token?}', 'Student\Auth\PasswordController@showResetForm')->middleware('home');
        Route::post('register', 'Student\Auth\AuthController@register');
        Route::get('register', 'Student\Auth\AuthController@showRegistrationForm')->middleware('home');

        // Student view routes
        Route::get('home', 'Student\HomeController@index');
    });

    // Teacher route group
    Route::group(['prefix' => '/teachers'], function () {

        //Teacher auth routes
        Route::get('login', 'Teacher\Auth\AuthController@showLoginForm')->middleware('home');
        Route::post('login', 'Teacher\Auth\AuthController@login');
        Route::get('logout', 'Teacher\Auth\AuthController@logout');
        Route::post('password/email', 'Teacher\Auth\PasswordController@sendResetLinkEmail');
        Route::post('password/reset', 'Teacher\Auth\PasswordController@reset');
        Route::get('password/reset/{token?}', 'Teacher\Auth\PasswordController@showResetForm')->middleware('home');;
        Route::post('register', 'Teacher\Auth\AuthController@register');

        // Manual registration is disabled
        // Route::get('register', 'Teacher\Auth\AuthController@showRegistrationForm');

        // Teacher view routes
        Route::get('home', 'Teacher\HomeController@index');
    });

    // LibraryStaff route group
    Route::group(['prefix' => '/libraryStaffs'], function () {

        //LibraryStaff auth routes
        Route::get('login', 'LibraryStaff\Auth\AuthController@showLoginForm')->middleware('home');
        Route::post('login', 'LibraryStaff\Auth\AuthController@login');
        Route::get('logout', 'LibraryStaff\Auth\AuthController@logout');
        Route::post('password/email', 'LibraryStaff\Auth\PasswordController@sendResetLinkEmail');
        Route::post('password/reset', 'LibraryStaff\Auth\PasswordController@reset');
        Route::get('password/reset/{token?}', 'LibraryStaff\Auth\PasswordController@showResetForm')->middleware('home');
        Route::post('register', 'LibraryStaff\Auth\AuthController@register');

        // Manual registration is disabled
        // Route::get('register', 'LibraryStaff\Auth\AuthController@showRegistrationForm');

        // LibraryStaff view routes
        Route::get('home', 'LibraryStaff\HomeController@index');
    });

    // HostelStaff route group
    Route::group(['prefix' => '/hostelStaffs'], function () {

        //HostelStaff auth routes
        Route::get('login', 'HostelStaff\Auth\AuthController@showLoginForm')->middleware('home');
        Route::post('login', 'HostelStaff\Auth\AuthController@login');
        Route::get('logout', 'HostelStaff\Auth\AuthController@logout');
        Route::post('password/email', 'HostelStaff\Auth\PasswordController@sendResetLinkEmail');
        Route::post('password/reset', 'HostelStaff\Auth\PasswordController@reset');
        Route::get('password/reset/{token?}', 'HostelStaff\Auth\PasswordController@showResetForm')->middleware('home');
        Route::post('register', 'HostelStaff\Auth\AuthController@register');

        // Manual registration is disabled
        // Route::get('register', 'HostelStaff\Auth\AuthController@showRegistrationForm');

        // HostelStaff view routes
        Route::get('home', 'HostelStaff\HomeController@index');
    });

    // AdminStaff route group
    Route::group(['prefix' => '/adminStaffs'], function () {

        //AdminStaff auth routes
        Route::get('login', 'AdminStaff\Auth\AuthController@showLoginForm')->middleware('home');
        Route::post('login', 'AdminStaff\Auth\AuthController@login');
        Route::get('logout', 'AdminStaff\Auth\AuthController@logout');
        Route::post('password/email', 'AdminStaff\Auth\PasswordController@sendResetLinkEmail');
        Route::post('password/reset', 'AdminStaff\Auth\PasswordController@reset');
        Route::get('password/reset/{token?}', 'AdminStaff\Auth\PasswordController@showResetForm')->middleware('home');
        Route::post('register', 'AdminStaff\Auth\AuthController@register');

        // Manual registration is disabled
        // Route::get('register', 'AdminStaff\Auth\AuthController@showRegistrationForm');

        // AdminStaff view routes
        Route::get('home', 'AdminStaff\HomeController@index');
    });

    // Admin route group
    Route::group(['prefix' => '/admins'], function () {

        //Admin auth routes
        Route::get('login', 'Admin\Auth\AuthController@showLoginForm')->middleware(['home', 'adminIp']);
        Route::post('login', 'Admin\Auth\AuthController@login');
        Route::get('logout', 'Admin\Auth\AuthController@logout');

        /*
         * Registration and password reset routes have not been
         * added for the admin.Password of admin should be
         * manually resetted from the database itself.
         */

        // Admin view routes
        Route::get('home', 'Admin\HomeController@index');
        Route::group(['prefix' => 'manage'], function () {

            // User account creation and deletion routes
            Route::get('teachers', 'Admin\HomeController@manageTeachers');
            Route::delete('teachers/{id?}', 'Admin\HomeController@removeTeacher');
            Route::get('libraryStaffs', 'Admin\HomeController@manageLibraryStaffs');
            Route::delete('libraryStaffs/{id?}', 'Admin\HomeController@removeLibraryStaff');
            Route::get('adminStaffs', 'Admin\HomeController@manageAdminStaffs');
            Route::delete('adminStaffs/{id?}', 'Admin\HomeController@removeAdminStaff');
            Route::get('hostelStaffs', 'Admin\HomeController@manageHostelStaffs');
            Route::delete('hostelStaffs/{id?}', 'Admin\HomeController@removeHostelStaff');
            Route::get('students', 'Admin\HomeController@manageStudents');
            Route::delete('students/{rollNo?}', 'Admin\HomeController@removeStudent');
        });
    });


});
