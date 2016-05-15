@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Please update your password</strong>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/teachers/firstLogin"
                          accept-charset="UTF-8" id="passwordUpdateForm">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <!-- Display Validation Errors -->
                        @include('common.errors')

                        <!-- First row password-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="password">Password</label>
                            <div class="col-md-6">
                                <input required class="form-control" name="password" type="password" id="password"
                                       onkeyup="checkPassword('passwordUpdateForm', 'updateButton')">
                            </div>
                        </div>

                        <!-- Second row confirm-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="confirmPassword">Confirm</label>
                            <div class="col-md-6">
                                <input required class="form-control" name="confirmPassword" type="password"
                                       id="confirmPassword"  onkeyup="checkPassword('passwordUpdateForm', 'updateButton')">
                            </div>
                        </div>

                        <!--Third row error msg-->
                        <div class="col-md-12">
                            <p id="passwordErrorMsg"></p>
                        </div>

                        <!-- Fourth row Update-->
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button class="btn btn-primary" type="submit" disabled id="updateButton">
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