@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-user"></span>
                        <strong> Update your profile picture</strong>
                    </div>
                    <div class="panel-body">
                        @include('student.partials.imageUplodForm')
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                        <form class="form-horizontal" role="form" method="POST" action="/students/updateInfo/info"
                              accept-charset="UTF-8" id="updateInfoForm">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                            <!-- First row name-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="name">Name</label>
                                <div class="col-md-4">
                                    <input required class="form-control" name="name" type="text"
                                           id="name" value={{$student -> name}}>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary" type="submit" id="UpdateButton">
                                        <span class="glyphicon glyphicon-edit"></span> Submit
                                    </button>
                                </div>
                            </div>

                            <!-- Second row email-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="email">Email</label>
                                <div class="col-md-4">
                                    <input required class="form-control" name="email" type="text"
                                           id="email" value={{$student -> email}}>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary" type="submit" id="UpdateButton">
                                        <span class="glyphicon glyphicon-edit"></span> Submit
                                    </button>
                                </div>
                            </div>

                            <!-- Third row Father Name-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="fatherName">Father's Name</label>
                                <div class="col-md-4">
                                    <input required class="form-control" name="fatherName" type="text"
                                           id="fatherName" value={{$student -> fatherName}}>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary" type="submit" id="UpdateButton">
                                        <span class="glyphicon glyphicon-edit"></span> Submit
                                    </button>
                                </div>
                            </div>

                            <!-- Fourth row Mother Name-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="motherName">Mother's Name</label>
                                <div class="col-md-4">
                                    <input required class="form-control" name="motherName" type="text"
                                           id="motherName" value={{$student -> motherName}}>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary" type="submit" id="UpdateButton">
                                        <span class="glyphicon glyphicon-edit"></span> Submit
                                    </button>
                                </div>
                            </div>

                            <!-- Fifth row Phone Number-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="phoneNo">Phone Number</label>
                                <div class="col-md-4">
                                    <input required class="form-control" name="phoneNo" type="text"
                                           id="phoneNo" value={{$student -> phoneNo}}>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary" type="submit" id="UpdateButton">
                                        <span class="glyphicon glyphicon-edit"></span> Submit
                                    </button>
                                </div>
                            </div>

                            <!-- Sixth row DOB-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="dob">Birth Date (mm-dd-yyy)</label>
                                <div class="col-md-4">
                                    <input required class="form-control" name="dob" type="date"
                                           id="dob" value={{$student -> dob}}>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary" type="submit" id="UpdateButton">
                                        <span class="glyphicon glyphicon-edit"></span> Submit
                                    </button>
                                </div>
                            </div>

                            <!-- Seventh row Current Address-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="currentAddress">Current Address</label>
                                <div class="col-md-4">
                                    <input required class="form-control" name="currentAddress" type="text"
                                           id="currentAddress" value={{$student -> currentAddress}}>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary" type="submit" id="UpdateButton">
                                        <span class="glyphicon glyphicon-edit"></span> Submit
                                    </button>
                                </div>
                            </div>

                            <!-- Eight row Permanent Address-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="permanentAddress">Permanent Address</label>
                                <div class="col-md-4">
                                    <input required class="form-control" name="permanentAddress" type="text"
                                           id="permanentAddress" value={{$student -> permanentAddress}}>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary" type="submit" id="UpdateButton">
                                        <span class="glyphicon glyphicon-edit"></span> Submit
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!--2nd Form for password -->
                        <form class="form-horizontal" role="form" method="POST" action="/students/updateInfo/password"
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