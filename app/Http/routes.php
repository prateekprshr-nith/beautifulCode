<?php

/*
 * This file contains all the routes for the application.
 */

Route::group(['middleware' => 'web'], function ()
{
    // Landing page
    Route::get('/', function ()
    {
        return view('welcome');
    })->middleware('home');


    // Student route group
    Route::group(['prefix' => '/students'], function ()
    {
        // Student auth routes
        Route::get('login', 'Student\Auth\AuthController@showLoginForm')->middleware('home');
        Route::post('login', 'Student\Auth\AuthController@login');
        Route::get('logout', 'Student\Auth\AuthController@logout');
        Route::post('password/email', 'Student\Auth\PasswordController@sendResetLinkEmail');
        Route::post('password/reset', 'Student\Auth\PasswordController@reset');
        Route::get('password/reset/{token?}', 'Student\Auth\PasswordController@showResetForm')->middleware('home');
        Route::post('register', 'Student\Auth\AuthController@register');
        Route::get('register', 'Student\Auth\AuthController@showRegistrationForm')->middleware('home');
        Route::get('verify', 'Student\Auth\VerificationController@showVerificationForm')->middleware('verified:student');
        Route::post('verify', 'Student\Auth\VerificationController@verifyUserAccount');
        Route::get('verify/sendVerificationMail', 'Student\Auth\VerificationController@sendVerifiactionMail')->middleware('verified:student');

        // Student info update routes
        Route::get('/updateInfo', 'Student\InformationUpdateController@showUpdateInfoForm');
        Route::patch('/updateInfo/info', 'Student\InformationUpdateController@updateInfo');
        Route::patch('/updateInfo/password', 'Student\InformationUpdateController@updatePassword');
        Route::get('updateInfo/image', 'Student\InformationUpdateController@showImageUploadForm')->middleware('hasImage');
        Route::patch('/updateInfo/image', 'Student\InformationUpdateController@updateImage');
        Route::get('updateInfo/image/skip', 'Student\InformationUpdateController@setImageUploadSkipSession')->middleware('hasImage');

        // Student view routes
        Route::get('home', 'Student\HomeController@index');
        Route::get('help', 'Student\HomeController@showHelpView');
        Route::group(['prefix' => '/semesterRegistration'], function ()
        {
            Route::get('initialDetails', 'Student\SemesterRegistrationController@showInitialDetailsView')->middleware('step:1');
            Route::put('initialDetails', 'Student\SemesterRegistrationController@addInitialDetails')->middleware('step:1');
            Route::get('feeAndHostelDetails', 'Student\SemesterRegistrationController@showFeeAndHostelDetailsView')->middleware('step:2');
            Route::put('feeAndHostelDetails', 'Student\SemesterRegistrationController@addFeeAndHostelDetails')->middleware('step:2');
            Route::get('courseDetails', 'Student\SemesterRegistrationController@showCourseDetailsView')->middleware('step:3');
            Route::put('courseDetails/electives', 'Student\SemesterRegistrationController@allocateElectives')->middleware('step:3');
            Route::get('courseDetails/electiveInfo/{courseCode}', 'Student\SemesterRegistrationController@getElectiveInfo')->middleware('step:3');
            Route::get('status', 'Student\SemesterRegistrationController@showRegistrationStatusView')->middleware('step:4');
            Route::patch('reUploadFeeReceipt', 'Student\SemesterRegistrationController@reUploadFeeReceipt')->middleware('step:4');
            Route::get('downloadRegistrationForm', 'Student\SemesterRegistrationController@getRegistrationForm')->middleware('step:4');
        });

        // Student image route, fetches the image of student
        Route::get('image', 'Student\HomeController@getImage');

    });


    // Teacher route group
    Route::group(['prefix' => '/teachers'], function ()
    {
        // Teacher auth routes
        Route::get('login', 'Teacher\Auth\AuthController@showLoginForm')->middleware('home');
        Route::post('login', 'Teacher\Auth\AuthController@login');
        Route::get('logout', 'Teacher\Auth\AuthController@logout');
        Route::post('password/email', 'Teacher\Auth\PasswordController@sendResetLinkEmail');
        Route::post('password/reset', 'Teacher\Auth\PasswordController@reset');
        Route::get('password/reset/{token?}', 'Teacher\Auth\PasswordController@showResetForm')->middleware('home');
        Route::post('register', 'Teacher\Auth\AuthController@register');
        Route::get('firstLogin', 'Teacher\Auth\FirstLoginController@showPasswordUpdateForm')->middleware('normalLogin:teacher');
        Route::put('firstLogin', 'Teacher\Auth\FirstLoginController@updatePassword');

        // Teacher info update routes
        Route::get('/updateInfo', 'Teacher\InformationUpdateController@showUpdateInfoForm');
        Route::patch('/updateInfo/info', 'Teacher\InformationUpdateController@updateInfo');
        Route::patch('/updateInfo/password', 'Teacher\InformationUpdateController@updatePassword');

        // Manual registration is disabled
        // Route::get('register', 'Teacher\Auth\AuthController@showRegistrationForm');

        // Teacher view routes
        Route::get('home', 'Teacher\HomeController@index');
        Route::get('help', 'Teacher\HomeController@showHelpView');
        Route::get('electives', 'Teacher\HomeController@showElectiveSelectionView');
        Route::get('electives/{courseCode}', 'Teacher\HomeController@getElectiveList');
        Route::group(['prefix' => '/semesterRegistration'], function ()
        {
            // Routes for semester and course selection
            Route::get('semester', 'Teacher\SemesterRegistrationController@showSemesterSelectionView');
            Route::put('semester', 'Teacher\SemesterRegistrationController@addSemester');
            Route::get('courses', 'Teacher\SemesterRegistrationController@showCourseSelectionView');
            Route::put('electives', 'Teacher\SemesterRegistrationController@addElectiveCounts');

            // Routes for managing student requests
            Route::group(['prefix' => '/studentRequests'], function ()
            {
                Route::get('new', 'Teacher\SemesterRegistrationController@showNewRequestsView');
                Route::get('pending', 'Teacher\SemesterRegistrationController@showPendingRequestsView');
                Route::get('approved', 'Teacher\SemesterRegistrationController@showApprovedRequestsView');
                Route::get('all', 'Teacher\SemesterRegistrationController@showAllRequestsView');
                Route::patch('approve', 'Teacher\SemesterRegistrationController@approveRequest');
                Route::patch('hold', 'Teacher\SemesterRegistrationController@holdRequest');
                Route::delete('delete', 'Teacher\SemesterRegistrationController@deleteRequest');
                Route::patch('register', 'Teacher\SemesterRegistrationController@registerStudent');
                Route::get('feeReceipts/{rollNo}', 'Teacher\SemesterRegistrationController@getFeeReceiptImage');
                Route::get('studentInfo/{rollNo}', 'Teacher\SemesterRegistrationController@getStudentInfo');
            });
        });

    });


    // LibraryStaff route group
    Route::group(['prefix' => '/libraryStaffs'], function ()
    {
        // LibraryStaff auth routes
        Route::get('login', 'LibraryStaff\Auth\AuthController@showLoginForm')->middleware('home');
        Route::post('login', 'LibraryStaff\Auth\AuthController@login');
        Route::get('logout', 'LibraryStaff\Auth\AuthController@logout');
        Route::post('password/email', 'LibraryStaff\Auth\PasswordController@sendResetLinkEmail');
        Route::post('password/reset', 'LibraryStaff\Auth\PasswordController@reset');
        Route::get('password/reset/{token?}', 'LibraryStaff\Auth\PasswordController@showResetForm')->middleware('home');
        Route::post('register', 'LibraryStaff\Auth\AuthController@register');
        Route::get('firstLogin', 'LibraryStaff\Auth\FirstLoginController@showPasswordUpdateForm')->middleware('normalLogin:libraryStaff');
        Route::put('firstLogin', 'LibraryStaff\Auth\FirstLoginController@updatePassword');

        // LibraryStaff info update routes
        Route::get('/updateInfo', 'LibraryStaff\InformationUpdateController@showUpdateInfoForm');
        Route::patch('/updateInfo/info', 'LibraryStaff\InformationUpdateController@updateInfo');
        Route::patch('/updateInfo/password', 'LibraryStaff\InformationUpdateController@updatePassword');

        // Manual registration is disabled
        // Route::get('register', 'LibraryStaff\Auth\AuthController@showRegistrationForm');

        // LibraryStaff view routes
        Route::get('home', 'LibraryStaff\HomeController@index');
        Route::get('help', 'LibraryStaff\HomeController@showHelpView');
        Route::group(['prefix' => '/semesterRegistration'], function ()
        {
            // Routes for managing student requests
            Route::group(['prefix' => '/studentRequests'], function ()
            {
                Route::get('new', 'LibraryStaff\SemesterRegistrationController@showNewRequestsView');
                Route::get('pending', 'LibraryStaff\SemesterRegistrationController@showPendingRequestsView');
                Route::get('approved', 'LibraryStaff\SemesterRegistrationController@showApprovedRequestsView');
                Route::patch('approve', 'LibraryStaff\SemesterRegistrationController@approveRequest');
                Route::patch('hold', 'LibraryStaff\SemesterRegistrationController@holdRequest');
                Route::get('studentInfo/{rollNo}', 'LibraryStaff\SemesterRegistrationController@getStudentInfo');
            });
        });
    });


    // HostelStaff route group
    Route::group(['prefix' => '/hostelStaffs'], function ()
    {
        // HostelStaff auth routes
        Route::get('login', 'HostelStaff\Auth\AuthController@showLoginForm')->middleware('home');
        Route::post('login', 'HostelStaff\Auth\AuthController@login');
        Route::get('logout', 'HostelStaff\Auth\AuthController@logout');
        Route::post('password/email', 'HostelStaff\Auth\PasswordController@sendResetLinkEmail');
        Route::post('password/reset', 'HostelStaff\Auth\PasswordController@reset');
        Route::get('password/reset/{token?}', 'HostelStaff\Auth\PasswordController@showResetForm')->middleware('home');
        Route::post('register', 'HostelStaff\Auth\AuthController@register');
        Route::get('firstLogin', 'HostelStaff\Auth\FirstLoginController@showPasswordUpdateForm')->middleware('normalLogin:hostelStaff');
        Route::put('firstLogin', 'HostelStaff\Auth\FirstLoginController@updatePassword');

        // HostelStaff info update routes
        Route::get('/updateInfo', 'HostelStaff\InformationUpdateController@showUpdateInfoForm');
        Route::patch('/updateInfo/info', 'HostelStaff\InformationUpdateController@updateInfo');
        Route::patch('/updateInfo/password', 'HostelStaff\InformationUpdateController@updatePassword');

        // Manual registration is disabled
        // Route::get('register', 'HostelStaff\Auth\AuthController@showRegistrationForm');

        // HostelStaff view routes
        Route::get('home', 'HostelStaff\HomeController@index');
        Route::get('help', 'HostelStaff\HomeController@showHelpView');
        Route::group(['prefix' => '/semesterRegistration'], function ()
        {
            // Routes for managing student requests
            Route::group(['prefix' => '/studentRequests'], function ()
            {
                Route::get('new', 'HostelStaff\SemesterRegistrationController@showNewRequestsView');
                Route::get('pending', 'HostelStaff\SemesterRegistrationController@showPendingRequestsView');
                Route::get('approved', 'HostelStaff\SemesterRegistrationController@showApprovedRequestsView');
                Route::patch('approve', 'HostelStaff\SemesterRegistrationController@approveRequest');
                Route::patch('hold', 'HostelStaff\SemesterRegistrationController@holdRequest');
                Route::get('studentInfo/{rollNo}', 'HostelStaff\SemesterRegistrationController@getStudentInfo');
            });
        });
    });


    // ChiefWardenStaff route group
    Route::group(['prefix' => '/chiefWardenStaffs'], function ()
    {
        // ChiefWardenStaff auth routes
        Route::get('login', 'ChiefWardenStaff\Auth\AuthController@showLoginForm')->middleware('home');
        Route::post('login', 'ChiefWardenStaff\Auth\AuthController@login');
        Route::get('logout', 'ChiefWardenStaff\Auth\AuthController@logout');
        Route::post('password/email', 'ChiefWardenStaff\Auth\PasswordController@sendResetLinkEmail');
        Route::post('password/reset', 'ChiefWardenStaff\Auth\PasswordController@reset');
        Route::get('password/reset/{token?}', 'ChiefWardenStaff\Auth\PasswordController@showResetForm')->middleware('home');
        Route::post('register', 'ChiefWardenStaff\Auth\AuthController@register');
        Route::get('firstLogin', 'ChiefWardenStaff\Auth\FirstLoginController@showPasswordUpdateForm')->middleware('normalLogin:chiefWardenStaff');
        Route::put('firstLogin', 'ChiefWardenStaff\Auth\FirstLoginController@updatePassword');

        // ChiefWardenStaff info update routes
        Route::get('/updateInfo', 'ChiefWardenStaff\InformationUpdateController@showUpdateInfoForm');
        Route::patch('/updateInfo/info', 'ChiefWardenStaff\InformationUpdateController@updateInfo');
        Route::patch('/updateInfo/password', 'ChiefWardenStaff\InformationUpdateController@updatePassword');

        // Manual registration is disabled
        // Route::get('register', 'ChiefWardenStaff\Auth\AuthController@showRegistrationForm');

        // ChiefWardenStaff view routes
        Route::get('home', 'ChiefWardenStaff\HomeController@index');
        Route::get('help', 'ChiefWardenStaff\HomeController@showHelpView');
        Route::group(['prefix' => '/semesterRegistration'], function ()
        {
            // Routes for managing student requests
            Route::group(['prefix' => '/studentRequests'], function ()
            {
                Route::get('new', 'ChiefWardenStaff\SemesterRegistrationController@showNewRequestsView');
                Route::get('pending', 'ChiefWardenStaff\SemesterRegistrationController@showPendingRequestsView');
                Route::get('approved', 'ChiefWardenStaff\SemesterRegistrationController@showApprovedRequestsView');
                Route::patch('approve', 'ChiefWardenStaff\SemesterRegistrationController@approveRequest');
                Route::patch('hold', 'ChiefWardenStaff\SemesterRegistrationController@holdRequest');
                Route::get('studentInfo/{rollNo}', 'ChiefWardenStaff\SemesterRegistrationController@getStudentInfo');
            });
        });
    });


    // AdminStaff route group
    Route::group(['prefix' => '/adminStaffs'], function ()
    {
        // AdminStaff auth routes
        Route::get('login', 'AdminStaff\Auth\AuthController@showLoginForm')->middleware('home');
        Route::post('login', 'AdminStaff\Auth\AuthController@login');
        Route::get('logout', 'AdminStaff\Auth\AuthController@logout');
        Route::post('password/email', 'AdminStaff\Auth\PasswordController@sendResetLinkEmail');
        Route::post('password/reset', 'AdminStaff\Auth\PasswordController@reset');
        Route::get('password/reset/{token?}', 'AdminStaff\Auth\PasswordController@showResetForm')->middleware('home');
        Route::post('register', 'AdminStaff\Auth\AuthController@register');
        Route::get('firstLogin', 'AdminStaff\Auth\FirstLoginController@showPasswordUpdateForm')->middleware('normalLogin:adminStaff');
        Route::put('firstLogin', 'AdminStaff\Auth\FirstLoginController@updatePassword');

        // AdminStaff info update routes
        Route::get('/updateInfo', 'AdminStaff\InformationUpdateController@showUpdateInfoForm');
        Route::patch('/updateInfo/info', 'AdminStaff\InformationUpdateController@updateInfo');
        Route::patch('/updateInfo/password', 'AdminStaff\InformationUpdateController@updatePassword');

        // Manual registration is disabled
        // Route::get('register', 'AdminStaff\Auth\AuthController@showRegistrationForm');

        // AdminStaff view routes
        Route::get('home', 'AdminStaff\HomeController@index');
        Route::get('help', 'AdminStaff\HomeController@showHelpView');
        Route::group(['prefix' => '/semesterRegistration'], function ()
        {
            // Routes for managing student requests
            Route::group(['prefix' => '/studentRequests'], function ()
            {
                Route::get('new', 'AdminStaff\SemesterRegistrationController@showNewRequestsView');
                Route::get('pending', 'AdminStaff\SemesterRegistrationController@showPendingRequestsView');
                Route::get('approved', 'AdminStaff\SemesterRegistrationController@showApprovedRequestsView');
                Route::patch('approve', 'AdminStaff\SemesterRegistrationController@approveRequest');
                Route::patch('hold', 'AdminStaff\SemesterRegistrationController@holdRequest');
                Route::get('studentInfo/{rollNo}', 'AdminStaff\SemesterRegistrationController@getStudentInfo');
            });
        });
    });


    // DepartmentStaff route group
    Route::group(['prefix' => '/departmentStaffs'], function ()
    {
        // DepartmentStaff auth routes
        Route::get('login', 'DepartmentStaff\Auth\AuthController@showLoginForm')->middleware('home');
        Route::post('login', 'DepartmentStaff\Auth\AuthController@login');
        Route::get('logout', 'DepartmentStaff\Auth\AuthController@logout');
        Route::post('password/email', 'DepartmentStaff\Auth\PasswordController@sendResetLinkEmail');
        Route::post('password/reset', 'DepartmentStaff\Auth\PasswordController@reset');
        Route::get('password/reset/{token?}', 'DepartmentStaff\Auth\PasswordController@showResetForm')->middleware('home');
        Route::post('register', 'DepartmentStaff\Auth\AuthController@register');
        Route::get('firstLogin', 'DepartmentStaff\Auth\FirstLoginController@showPasswordUpdateForm')->middleware('normalLogin:departmentStaff');
        Route::put('firstLogin', 'DepartmentStaff\Auth\FirstLoginController@updatePassword');

        // DepartmentStaff info update routes
        Route::get('/updateInfo', 'DepartmentStaff\InformationUpdateController@showUpdateInfoForm');
        Route::patch('/updateInfo/info', 'DepartmentStaff\InformationUpdateController@updateInfo');
        Route::patch('/updateInfo/password', 'DepartmentStaff\InformationUpdateController@updatePassword');

        // Manual registration is disabled
        // Route::get('register', 'DepartmentStaff\Auth\AuthController@showRegistrationForm');

        // DepartmentStaff view routes
        Route::get('home', 'DepartmentStaff\HomeController@index');
        Route::get('help', 'DepartmentStaff\HomeController@showHelpView');
        Route::group(['prefix' => 'manage'], function ()
        {
            // Course management routes
            Route::get('courses', 'DepartmentStaff\HomeController@manageCourses');
            Route::put('courses', 'DepartmentStaff\HomeController@addCourse');
            Route::delete('courses', 'DepartmentStaff\HomeController@removeCourse');
        });
    });


    // Admin route group
    Route::group(['prefix' => '/admins'], function ()
    {
        // Admin auth routes
        Route::get('login', 'Admin\Auth\AuthController@showLoginForm')->middleware(['home', 'adminIp']);
        Route::post('login', 'Admin\Auth\AuthController@login');
        Route::get('logout', 'Admin\Auth\AuthController@logout');

        // Admin info update routes
        Route::get('/updateInfo', 'Admin\InformationUpdateController@showUpdateInfoForm');
        Route::patch('/updateInfo', 'Admin\InformationUpdateController@updateInfo');

        /*
         * Registration and password reset routes have not been
         * added for the admin.Password of admin should be
         * manually resetted from the database itself.
         */

        // Admin view routes
        Route::get('home', 'Admin\HomeController@index');
        Route::get('help', 'Admin\HomeController@showHelpView');
        Route::group(['prefix' => 'manage'], function ()
        {
            // User account creation and deletion routes
            Route::get('teachers', 'Admin\HomeController@manageTeachers');
            Route::delete('teachers/{id?}', 'Admin\HomeController@removeTeacher');
            Route::get('libraryStaffs', 'Admin\HomeController@manageLibraryStaffs');
            Route::delete('libraryStaffs/{id?}', 'Admin\HomeController@removeLibraryStaff');
            Route::get('adminStaffs', 'Admin\HomeController@manageAdminStaffs');
            Route::delete('adminStaffs/{id?}', 'Admin\HomeController@removeAdminStaff');
            Route::get('hostelStaffs', 'Admin\HomeController@manageHostelStaffs');
            Route::delete('hostelStaffs/{id?}', 'Admin\HomeController@removeHostelStaff');
            Route::get('departmentStaffs', 'Admin\HomeController@manageDepartmentStaffs');
            Route::delete('departmentStaffs/{id?}', 'Admin\HomeController@removeDepartmentStaff');
            Route::get('chiefWardenStaffs', 'Admin\HomeController@manageChiefWardenStaffs');
            Route::delete('chiefWardenStaffs/{id?}', 'Admin\HomeController@removeChiefWardenStaff');
            Route::get('students', 'Admin\HomeController@manageStudents');
            Route::put('students/{rollNo?}', 'Admin\HomeController@verifyStudent');
            Route::delete('students/{rollNo?}', 'Admin\HomeController@removeStudent');

            // Department management routes
            Route::get('departments', 'Admin\HomeController@manageDepartments');
            Route::put('departments', 'Admin\HomeController@addDepartment');
            Route::delete('departments/{dCode?}', 'Admin\HomeController@removeDepartment');

            // Section management routes
            Route::get('sections', 'Admin\HomeController@manageSections');
            Route::put('sections', 'Admin\HomeController@addSection');
            Route::delete('sections/{sectionId?}', 'Admin\HomeController@removeSection');

            // Hostel management routes
            Route::get('hostels', 'Admin\HomeController@manageHostels');
            Route::put('hostels', 'Admin\HomeController@addHostel');
            Route::delete('hostels/{hostelId?}', 'Admin\HomeController@removeHostel');
        });

        // Semester registration process routes
        Route::get('toggleRegistrationProcess/{users}', 'Admin\HomeController@toggleRegistrationProcess');
    });
});