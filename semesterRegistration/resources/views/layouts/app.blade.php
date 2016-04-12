<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Online Semester Registration</title>

    <!-- Bootstrap -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/bootstrap/css/fileinput.min.css" media="all" rel="stylesheet">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/bootstrap/js/jquery.min.js"></script>

    <!-- Java script files -->
    <script src="/bootstrap/js/custom.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <script src="/bootstrap/js/fileinput.min.js"></script>
    <script src="/bootstrap/js/plugins/canvas-to-blob.min.js"></script>

    <style>
        .panel-heading p {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: normal;
            width: 75%;
            padding-top: 8px;
        }

        hr.gradientHr {
            border: 0;
            height: 1px;
            background-image: -webkit-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
            background-image: -moz-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
            background-image: -ms-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
            background-image: -o-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
        }
    </style>
</head>

<body>

<div class="container-fluid">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mynavbar-content">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Online Semester Registration</a>
            </div>

            <div class="collapse navbar-collapse" id="mynavbar-content">

                <!--
                     Get the user. Please note that this code is a
                     bit tricky. Do not try to change it. But
                     if you did try that and failed then
                     increment the counter below :D.

                     No. of hours wasted = 0
                -->

                @if(Auth::guard('student')->user())
                    {{-- */$user= 'student';/* --}}
                @elseif(Auth::guard('teacher')->user())
                    {{-- */$user = 'teacher';/* --}}
                @elseif(Auth::guard('libraryStaff')->user())
                    {{-- */$user = 'libraryStaff';/* --}}
                @elseif(Auth::guard('hostelStaff')->user())
                    {{-- */$user = 'hostelStaff';/* --}}
                @elseif(Auth::guard('departmentStaff')->user())
                {{-- */$user = 'departmentStaff';/* --}}
                @elseif(Auth::guard('adminStaff')->user())
                    {{-- */$user = 'adminStaff';/* --}}
                @elseif(Auth::guard('chiefWardenStaff')->user())
                    {{-- */$user = 'chiefWardenStaff';/* --}}
                @elseif(Auth::guard('admin')->user())
                    {{-- */$user = 'admin';/* --}}
                @elseif(Auth::guest())
                    {{-- */$user = 'guest';/* --}}
                @endif

                @if($user != 'guest')
                    <!-- #TODO add the other tabs here -->

                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="/{{$user}}s/home">Home</a></li>

                        <!-- Tabs for department staff users -->
                        @if($user == 'student')
                            <li><a href="/{{$user}}s/semesterRegistration/initialDetails">Semester Registration</a></li>
                        @endif

                        <!-- Tabs for department staff users -->
                        @if($user == 'departmentStaff')
                            <li><a href="/{{$user}}s/manage/courses">Courses</a></li>
                        @endif

                        <!-- Tabs for faculty  users -->
                        @if($user == 'teacher')
                            <li><a href="/{{$user}}s/semesterRegistration/semester">Register as an incharge</a></li>
                        @endif

                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                @if($user == 'admin')
                                    <strong>
                                        Admin
                                    </strong>
                                @else
                                    @if($user == 'student')
                                        <img src="{{ url('/students/image') }}" id="avatarImage" width="20" height="20"
                                             class="img-rounded" alt="Cinque Terre" onerror="loadAvatarIcon()">
                                    @endif
                                    <strong>
                                        {{Auth::guard($user)->user()->name}}
                                    </strong>
                                @endif
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="/{{$user}}s/updateInfo"><span class="glyphicon glyphicon-refresh"></span> Update Profile</a></li>
                                <li><a href="/{{$user}}s/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                @else
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="/students/register"><span class="glyphicon glyphicon-user"></span> Register</a></li>
                        <li><a href="/students/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    </ul>
                @endif

            </div>
        </div>
    </nav>
</div>

@yield('content')

</body>
</html>