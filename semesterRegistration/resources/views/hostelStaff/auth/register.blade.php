@extends('admin.manage.hostelStaffs')

@section('hostelStaffRegPanel')
    <div class="container col-sm-offset-2 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="glyphicon glyphicon-plus"></span>
                <strong> Add a new hostel staff member</strong>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="/hostelStaffs/register"
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

                    <!-- Second ID and Hostel ID -->
                    <div class="row">
                        <div class="form-group row col-md-6 center-block">

                            <label class="col-md-4 control-label" for="id">ID</label>

                            <div class="col-md-8">
                                <input required class="form-control" name="id" type="text" id="id">
                            </div>
                        </div>
                        <div class="form-group row col-md-6 center-block">

                            <label class="col-md-4 control-label" for="hostelId">Hostel Id</label>

                            <div class="col-md-8">
                                <select required id="hostelId" name="hostelId" class="form-control">
                                    <option value="">Select a Hostel...</option>
                                    @foreach($hostels as $hostel)
                                        <option value="{{$hostel->hostelId}}">{{$hostel->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Third row passwords-->
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

                    <!--Fourth row error msg-->
                    <div class="col-md-12">
                            <p id="passwordErrorMsg"></p>
                    </div>

                    <!-- Fifth row Register-->
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