@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Login: Please enter your details correctly</strong>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="/teachers/login" accept-charset="UTF-8" id="loginForm">
                            <input required name="_token" type="hidden">
                            {{ csrf_field() }}

                            <!-- Display Validation Errors -->
                            @include('common.errors')

                            <!-- First row facultyId-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="facultyId">Faculty Id</label>
                                <div class="col-md-6">
                                    <input required class="form-control" name="facultyId" type="text" id="facultyId">
                                </div>
                            </div>

                            <!-- Second row password-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="password">Password</label>
                                <div class="col-md-6">
                                    <input required class="form-control" name="password" type="password" id="password">
                                </div>
                            </div>

                            <!-- Third row remember me-->
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Fourth row Login-->
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button class="btn btn-primary" type="submit" id="loginButton">
                                        <span class="glyphicon glyphicon-log-in"></span> Login
                                    </button>
                                    <!--TODO ask this. -->
                                    <a class="btn btn-link" href="/teachers/password/reset">Forgot Your Password?</a>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection