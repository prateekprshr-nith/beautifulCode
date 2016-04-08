@extends('admin.manage.teachers')

@section('teacherRegPanel')
    <div class="container col-sm-offset-2 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="glyphicon glyphicon-plus"></span>
                <strong> Add a new teacher</strong>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="/teachers/register"
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

                    <!-- Second row Faculty ID  -->
                    <div class="row">
                        <div class="form-group row col-md-6 center-block">

                            <label class="col-md-4 control-label" for="facultyId">Faculty ID</label>

                            <div class="col-md-8">
                                <input required class="form-control" name="facultyId" type="text" id="facultyId">
                            </div>
                        </div>
                    </div>

                    <!-- Third row Department and Office -->
                    <div class="row">
                        <div class="form-group row col-md-6 center-block">

                            <label class="col-md-4 control-label" for="department">Department</label>

                            <div class="col-md-8">
                                <select required id="department" name="dCode" class="form-control">
                                    <option value="">Select a Department...</option>
                                    @foreach($departments as $department)
                                        <option value="{{$department->dCode}}">{{$department->dName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row col-md-6 center-block">

                            <label class="col-md-4 control-label" for="office">Office</label>

                            <div class="col-md-8">
                                <input required class="form-control" name="office" type="text" id="office">
                            </div>
                        </div>
                    </div>


                    <!-- Fourth row passwords-->
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