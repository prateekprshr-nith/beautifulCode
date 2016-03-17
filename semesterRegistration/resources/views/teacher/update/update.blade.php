@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-info-sign"></span>
                        <strong> Update: Please enter your details correctly</strong>
                    </div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form class="form-horizontal" role="form" method="POST" action="/teachers/updateInfo"
                              accept-charset="UTF-8" id="updateInfoForm">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                            <!-- Display Validation Errors -->
                            @include('common.errors')

                            <!-- Arnav and mumuksh write your code here-->

                            <!-- First row current password-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="password">New password</label>
                                <div class="col-md-6">
                                    <input required class="form-control" name="password" type="password"
                                           id="password" onkeyup="checkPassword('updateInfoForm', 'updateInfoButton')">
                                </div>
                            </div>

                            <!-- Second row new password-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="confirmPassword">Confirm</label>
                                <div class="col-md-6">
                                    <input required class="form-control" name="confirmPassword" type="password"
                                           id="confirmPassword" onkeyup="checkPassword('updateInfoForm', 'updateInfoButton')">
                                </div>
                            </div>

                            <!-- Third row error msg-->
                            <div class="col-md-12">
                                <p id="passwordErrorMsg"></p>
                            </div>

                            <!-- Fourth row update-->
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button class="btn btn-primary" type="submit" id="updateInfoButton">
                                        <span class="glyphicon glyphicon-refresh"></span> Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection