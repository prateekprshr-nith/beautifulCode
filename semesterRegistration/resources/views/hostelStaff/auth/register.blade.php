@extends('admin.manage.hostelStaffs')

@section('hostelStaffRegPanel')
    <div class="container col-sm-offset-2 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>Add a new hostel staff member</strong>
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

                            <label class="col-md-4 control-label" for="department">Department</label>

                            <div class="col-md-8">
                                <select required id="department" name="dCode" class="form-control">
                                    <option value="">Select a Department...</option>
                                    <option value="CSED">Computer Science and Engineering Dept.</option>
                                    <option value="ECED">Electronics and Communication Engineering Dept.</option>
                                    <option value="EED">Electrical and Electronics Engineering Dept.</option>
                                    <option value="MED">Mechanical Engineering Dept.</option>
                                    <option value="CED">Civil Engineering Dept.</option>
                                    <option value="CHED">Chemical Engineering Dept.</option>
                                    <option value="ARD">Architecture Dept.</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row col-md-6 center-block">

                            <label class="col-md-4 control-label" for="section">Section</label>

                            <div class="col-md-8">
                                <select required class="form-control" name="sectionId" id="section">
                                    <option value="">Select a Section...</option>
                                    <option value="A1">A1</option>
                                    <option value="A2">A2</option>
                                    <option value="A3">A3</option>
                                    <option value="B1">B1</option>
                                    <option value="B2">B2</option>
                                    <option value="B3">B3</option>
                                    <option value="C1">C1</option>
                                    <option value="C2">C2</option>
                                    <option value="C3">C3</option>
                                    <option value="D1">D1</option>
                                    <option value="D2">D2</option>
                                    <option value="D3">D3</option>
                                    <option value="E1">E1</option>
                                    <option value="E2">E2</option>
                                    <option value="F1">F1</option>
                                    <option value="F2">F2</option>
                                    <option value="G1">G1</option>
                                    <option value="G2">G2</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Sixth row DOB no and phone number-->
                    <div class="row">
                        <div class="form-group row col-md-6 center-block">

                            <label class="col-md-4 control-label" for="dob">Birth Date</label>

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
                            <textarea required class="form-control" rows="2" name="currentAddress" type="text"
                                      id="currentAddress">

                            </textarea>
                            </div>
                        </div>
                        <div class="form-group row col-md-6 center-block">

                            <label class="col-md-4 control-label" for="permanentAddress">Permanent address</label>

                            <div class="col-md-8">
                            <textarea required class="form-control" rows="2" name="permanentAddress" type="text"
                                      id="permanentAddress">

                            </textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Eighth row passwords-->
                    <div class="row">
                        <div class="form-group row col-md-6 center-block">

                            <label class="col-md-4 control-label" for="password">Password</label>

                            <div class="col-md-8">
                                <input required class="form-control" name="password" type="password" id="password"
                                       onkeyup="checkPassword()">
                            </div>
                        </div>
                        <div class="form-group row col-md-6 center-block">

                            <label class="col-md-4 control-label" for="confirmPassword">Confirm</label>

                            <div class="col-md-8">
                                <input required class="form-control" name="confirmPassword" type="password"
                                       id="confirmPassword" onkeyup="checkPassword()">
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