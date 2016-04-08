@extends('layouts.app')

@section('content')
    <div class="container col-md-offset-2 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="glyphicon glyphicon-user"></span>
                <strong> Registration: Please enter your details correctly</strong>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="/students/register"
                      accept-charset="UTF-8" id="registerForm">
                    <input required name="_token" type="hidden">
                    {{ csrf_field() }}

                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- First row Name and Email-->
                    <div class="row">
                        <div class="form-group row col-md-6 center-block">
                            <label class="col-md-4 control-label" for="name">Name</label>
                            <div class="col-md-8">
                                <input required class="form-control" name="name" type="text" id="name">
                            </div>
                        </div>
                        <div class="form-group row col-md-6 center-block">

                            <label class="col-md-4 control-label" for="email">Email</label>
                            <div class="col-md-8">
                                <input required class="form-control" name="email" type="email" id="email">

                            </div>
                        </div>
                    </div>

                    <!-- Second row father and mother name -->
                    <div class="row">
                        <div class="form-group row col-md-6 center-block">

                            <label class="col-md-4 control-label" for="fatherName">Father's Name</label>

                            <div class="col-md-8">
                                <input required class="form-control" name="fatherName" type="text" id="fatherName">
                            </div>
                        </div>
                        <div class="form-group row col-md-6 center-block">

                            <label class="col-md-4 control-label" for="motherName">Mother's Name</label>

                            <div class="col-md-8">
                                <input required class="form-control" name="motherName" type="text" id="motherName">
                            </div>
                        </div>
                    </div>

                    <!-- Third row Roll no and semester -->
                    <div class="row">
                        <div class="form-group row col-md-6 center-block">

                            <label class="col-md-4 control-label" for="rollNo">Roll No</label>

                            <div class="col-md-8">
                                <input required class="form-control" name="rollNo" type="text" id="rollNo">
                            </div>
                        </div>
                        <div class="form-group row col-md-6 center-block">

                            <label class="col-md-4 control-label" for="semester">Semester</label>

                            <div class="col-md-8">
                                <input required class="form-control" name="semNo" type="text" id="semester">
                            </div>
                        </div>
                    </div>

                    <!-- Fourth row registration no -->
                    <div class="row">
                        <div class="form-group row col-md-6 center-block">

                            <label class="col-md-4 control-label" for="registrationNo">Registration No</label>

                            <div class="col-md-8">
                                <input required class="form-control" name="registrationNo" type="text"
                                       id="registrationNo">
                            </div>
                        </div>
                    </div>

                    <!-- Fifht row Department and Section-->
                    <div class="row">
                        <div class="form-group row col-md-6 center-block">

                            <label class="col-md-4 control-label" for="dCode">Department</label>

                            <div class="col-md-8">
                                <select required id="dCode" name="dCode" class="form-control">
                                    <option value="">Select a Department...</option>
                                    @foreach($departments as $department)
                                        <option value="{{$department->dCode}}">{{$department->dName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row col-md-6 center-block">

                            <label class="col-md-4 control-label" for="section">Section</label>

                            <div class="col-md-8">
                                <select required class="form-control" name="sectionId" id="section">
                                    <option value="">Select a Section...</option>
                                    @foreach($sections as $section)
                                        <option value="{{$section->sectionId}}">{{$section->sectionId}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Sixth row DOB no and phone number-->
                    <div class="row">
                        <div class="form-group row col-md-6 center-block">

                            <label class="col-md-4 control-label" for="dob">Birth Date (yyyy-mm-dd)</label>

                            <div class="col-md-8">
                                <input required class="form-control" name="dob" type="date" id="dob">
                            </div>
                        </div>
                        <div class="form-group row col-md-6 center-block">

                            <label class="col-md-4 control-label" for="phoneNo">Phone No</label>

                            <div class="col-md-8">
                                <input required class="form-control" name="phoneNo" type="tel" id="phoneNo">
                            </div>
                        </div>
                    </div>

                    <!-- Seventh row addresses-->
                    <div class="row">
                        <div class="form-group row col-md-6 center-block">

                            <label class="col-md-4 control-label" for="currentAddress">Current address</label>

                            <div class="col-md-8">
                            <textarea required class="form-control verticalAlign" rows="2" name="currentAddress" id="currentAddress"></textarea>
                            </div>
                        </div>
                        <div class="form-group row col-md-6 center-block">

                            <label class="col-md-4 control-label" for="permanentAddress">Permanent address</label>

                            <div class="col-md-8">
                            <textarea required class="form-control verticalAlign" rows="2" name="permanentAddress" id="permanentAddress"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Eighth row passwords-->
                    <div class="row">
                        <div class="form-group row col-md-6 center-block">

                            <label class="col-md-4 control-label" for="password">Password</label>

                            <div class="col-md-8">
                                <input required class="form-control" name="password" type="password" id="password"
                                       onkeyup="checkPassword('registerForm', 'registerButton')">
                            </div>
                        </div>
                        <div class="form-group row col-md-6 center-block">

                            <label class="col-md-4 control-label" for="confirmPassword">Confirm</label>

                            <div class="col-md-8">
                                <input required class="form-control" name="confirmPassword" type="password"
                                       id="confirmPassword" onkeyup="checkPassword('registerForm', 'registerButton')">
                            </div>
                        </div>
                    </div>

                    <!--Ninth row error msg-->
                    <div class="col-md-12">
                            <p id="passwordErrorMsg"></p>
                    </div>

                    <!-- Tenth row Register-->
                    <div class="row">
                        <div class="form-group row col-md-6 center-block">
                            <div class="col-md-4 text-right ">
                            </div>
                            <div class="col-md-4 center-block">
                                <button class="btn btn-primary" type="submit" disabled id="registerButton">
                                    <span class="glyphicon glyphicon-user"></span> Register
                                </button>
                            </div>
                        </div>
                        <div class="form-group row col-md-6 center-block">
                            <div class="col-md-4 text-right ">
                            </div>
                            <div class="col-md-4 center-block">
                                <button class="btn btn-danger" onclick="reset()">
                                    <span class="glyphicon glyphicon-refresh"></span> Reset
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection