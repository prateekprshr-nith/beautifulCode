<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'student',
        'passwords' => 'students',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "session", "token"
    |
    */

    'guards' => [
        'student' => [
            'driver' => 'session',
            'provider' => 'students',
        ],

        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],

        'teacher' => [
            'driver' => 'session',
            'provider' => 'teachers',
        ],

        'libraryStaff' => [
            'driver' => 'session',
            'provider' => 'libraryStaffs',
        ],

        'hostelStaff' => [
            'driver' => 'session',
            'provider' => 'hostelStaffs',
        ],

        'adminStaff' => [
            'driver' => 'session',
            'provider' => 'adminStaffs',
        ],

        'chiefWardenStaff' => [
            'driver' => 'session',
            'provider' => 'chiefWardenStaffs',
        ],

        'departmentStaff' => [
            'driver' => 'session',
            'provider' => 'departmentStaffs',
        ],

        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'token',
            'provider' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'students' => [
            'driver' => 'eloquent',
            'model' => App\Student::class,
        ],

        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Admin::class,
        ],

        'hostelStaffs' => [
            'driver' => 'eloquent',
            'model' => App\HostelStaff::class,
        ],

        'libraryStaffs' => [
            'driver' => 'eloquent',
            'model' => App\LibraryStaff::class,
        ],

        'adminStaffs' => [
            'driver' => 'eloquent',
            'model' => App\AdminStaff::class,
        ],

        'chiefWardenStaffs' => [
            'driver' => 'eloquent',
            'model' => App\ChiefWardenStaff::class,
        ],

        'departmentStaffs' => [
            'driver' => 'eloquent',
            'model' => App\DepartmentStaff::class,
        ],

        'teachers' => [
            'driver' => 'eloquent',
            'model' => App\Teacher::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | Here you may set the options for resetting passwords including the view
    | that is your password reset e-mail. You may also set the name of the
    | table that maintains all of the reset tokens for your application.
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application and you want to have
    | separate password reset settings based on the specific user types.
    |
    | The expire time is the number of minutes that the reset token should be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    */

    'passwords' => [
        'students' => [
            'provider' => 'students',
            'email' => 'student.auth.emails.password',
            'table' => 'password_resets',
            'expire' => 60,
        ],

        'teachers' => [
            'provider' => 'teachers',
            'email' => 'teacher.auth.emails.password',
            'table' => 'password_resets',
            'expire' => 60,
        ],

        'adminStaffs' => [
            'provider' => 'adminStaffs',
            'email' => 'adminStaff.auth.emails.password',
            'table' => 'password_resets',
            'expire' => 60,
        ],

        'libraryStaffs' => [
            'provider' => 'libraryStaffs',
            'email' => 'libraryStaff.auth.emails.password',
            'table' => 'password_resets',
            'expire' => 60,
        ],

        'hostelStaffs' => [
            'provider' => 'hostelStaffs',
            'email' => 'hostelStaff.auth.emails.password',
            'table' => 'password_resets',
            'expire' => 60,
        ],

        'chiefWardenStaffs' => [
            'provider' => 'chiefWardenStaffs',
            'email' => 'chiefWardenStaff.auth.emails.password',
            'table' => 'password_resets',
            'expire' => 60,
        ],

        'departmentStaffs' => [
            'provider' => 'departmentStaffs',
            'email' => 'departmentStaff.auth.emails.password',
            'table' => 'password_resets',
            'expire' => 60,
        ],
    ],

];