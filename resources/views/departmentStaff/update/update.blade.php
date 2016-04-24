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
                        <form class="form-horizontal" role="form" method="POST" action="/departmentStaffs/updateInfo/info"
                              accept-charset="UTF-8" id="updateInfoForm">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                            <!-- Display Validation Errors -->
                            @include('common.errors')

                            <!-- First row name-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="name">Name</label>
                                <div class="col-md-4">
                                    <input required class="form-control" name="name" type="text"
                                           id="name" value="{{$departmentStaff->name}}">
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary" type="submit" id="UpdateButton">
                                        <span class="glyphicon glyphicon-edit"></span> Submit
                                    </button>
                                </div>
                            </div>

                            <!-- Second row Department id ask about the drop down list -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="dCode">Department</label>
                                <div class="col-md-4">
                                    <select required id="dCode" name="dCode" class="form-control">
                                        <option value="">Select a Department...</option>
                                        @foreach($departments as $department)
                                            @if($departmentStaff->dCode == $department->dCode)
                                                <option value="{{$department->dCode}}" selected>{{$department->dName}}</option>
                                            @else
                                                <option value="{{$department->dCode}}">{{$department->dName}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary" type="submit" id="UpdateButton">
                                        <span class="glyphicon glyphicon-edit"></span> Submit
                                    </button>
                                </div>
                            </div>
                            <!-- Third row email-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="email">Email</label>
                                <div class="col-md-4">
                                    <input required class="form-control" name="email" type="text"
                                           id="email" value="{{$departmentStaff->email}}">
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary" type="submit" id="UpdateButton">
                                        <span class="glyphicon glyphicon-edit"></span> Submit
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!--2nd Form for password -->
                        <form class="form-horizontal" role="form" method="POST" action="/departmentStaffs/updateInfo/password"
                              accept-charset="UTF-8" id="updatePasswordForm">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                                    <!-- First row password-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="password">Password</label>
                                <div class="col-md-4">
                                    <input required class="form-control" name="password" type="password"
                                           id="password" onkeyup="checkPassword('updatePasswordForm', 'updatePasswordButton')"
                                    >
                                </div>
                            </div>

                            <!-- Second row confirm password-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="confirmPassword">Confirm Password</label>
                                <div class="col-md-4">
                                    <input required class="form-control" name="confirmPassword" type="password"
                                           id="updatePassword" onkeyup="checkPassword('updatePasswordForm', 'updatePasswordButton')"
                                    >
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary" type="submit" id="updatePasswordButton">
                                        <span class="glyphicon glyphicon-edit"></span> Submit
                                    </button>
                                </div>
                            </div>

                            <!-- Third error msg-->
                            <div class="col-md-12">
                                <p id="passwordErrorMsg"></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection