@extends('layouts.app')

@section('content')
    <div class="container col-sm-offset-2 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                Login: Please enter your details correctly
            </div>
            <div class="panel-body">
                <form method="POST" action="/students/login" accept-charset="UTF-8" id="loginForm">
                    <input required name="_token" type="hidden">
                    {{ csrf_field() }}

                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- First row Roll no-->
                    <div class="row">
                        <div class="form-group row col-md-12 center-block">
                            <div class="col-md-3 text-right">
                                <label for="rollNo">Roll No</label>
                            </div>
                            <div class="col-md-6">
                                <input required class="form-control" name="rollNo" type="text" id="rollNo">
                            </div>
                        </div>
                    </div>

                    <!-- Second row password-->
                    <div class="row">
                        <div class="form-group row col-md-12 center-block">
                            <div class="col-md-3 text-right ">
                                <label for="password">Password</label>
                            </div>
                            <div class="col-md-6">
                                <input required class="form-control" name="password" type="password" id="password">
                            </div>
                        </div>
                    </div>

                    <!-- Third row Login-->
                    <div class="row">
                        <div class="form-group row col-md-12 center-block">
                            <div class="col-md-3">
                            </div>
                            <div class="form-group col-md-offset-3 col-md-3 center-block">
                                <button class="btn btn-default" type="submit" id="loginButton">
                                    <span class="glyphicon glyphicon-log-in"></span> Login
                                </button>
                            </div>
                            <div class="form-group col-md-offset-3 col-md-3 center-block">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection