@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- First panel: Manage users -->
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="glyphicon glyphicon-dashboard"></span>
                <strong> Manage Users</strong>
            </div>
            <div class="panel-body">
                <div class="btn-group btn-group-justified">
                    <a href="/admins/manage/teachers" class="btn btn-default">
                        <span class="glyphicon glyphicon-user"></span> Teachers
                    </a>
                    <a href="/admins/manage/hostelStaffs" class="btn btn-default">
                        <span class="glyphicon glyphicon-user"></span> Hostel Staff
                    </a>
                    <a href="/admins/manage/departmentStaffs" class="btn btn-default">
                        <span class="glyphicon glyphicon-user"></span> Department Staff
                    </a>
                    <a href="/admins/manage/adminStaffs" class="btn btn-default">
                        <span class="glyphicon glyphicon-user"></span> Accounts Staff
                    </a>
                    <a href="/admins/manage/libraryStaffs" class="btn btn-default">
                        <span class="glyphicon glyphicon-user"></span> Library Staff
                    </a>
                    <a href="/admins/manage/chiefWardenStaffs" class="btn btn-default">
                        <span class="glyphicon glyphicon-user"></span> Chief Warden Staff
                    </a>
                    <a href="/admins/manage/students" class="btn btn-default">
                        <span class="glyphicon glyphicon-user"></span> Students
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Second panle: Manage Departments, Sections and Hostels-->
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="glyphicon glyphicon-dashboard"></span>
                <strong> Manage Departments, Sections and Hostels</strong>
            </div>
            <div class="panel-body">
                <div class="btn-group btn-group-justified">
                    <a href="/admins/manage/departments" class="btn btn-default">
                        <span class="glyphicon glyphicon-user"></span> Departments
                    </a>
                    <a href="/admins/manage/sections" class="btn btn-default">
                        <span class="glyphicon glyphicon-user"></span> Sections
                    </a>
                    <a href="/admins/manage/hostels" class="btn btn-default">
                        <span class="glyphicon glyphicon-user"></span> Hostels
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="glyphicon glyphicon-dashboard"></span>
                <strong> Manage Semester Registration Process</strong>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Users</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Staff</td>

                            @if($staffRegistrationStatus == 'Activated')
                                <td class="text-info">{{$staffRegistrationStatus}}</td>
                            @else
                                <td class="text-muted">{{$staffRegistrationStatus}}</td>
                            @endif

                            <td>
                                @if($staffRegistrationStatus == 'Activated')
                                    <a href="/admins/toggleRegistrationProcess/staff"
                                       class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                        <span class="glyphicon glyphicon-remove"></span> De-Activate
                                    </a>
                                @else
                                    <a href="/admins/toggleRegistrationProcess/staff"
                                       class="btn btn-sm btn-primary" onclick="return confirm('Are you sure?')">
                                        <span class="glyphicon glyphicon-ok"></span> Activate
                                    </a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Students</td>

                            @if($studentRegistrationStatus == 'Activated')
                                <td class="text-info">{{$studentRegistrationStatus}}</td>
                            @else
                                <td class="text-muted">{{$studentRegistrationStatus}}</td>
                            @endif

                            <td>
                                @if($studentRegistrationStatus == 'Activated')
                                    <a href="/admins/toggleRegistrationProcess/students"
                                       class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                        <span class="glyphicon glyphicon-remove"></span> De-Activate
                                    </a>
                                @else
                                    <a href="/admins/toggleRegistrationProcess/students"
                                       class="btn btn-sm btn-primary" onclick="return confirm('Are you sure?')">
                                        <span class="glyphicon glyphicon-ok"></span> Activate
                                    </a>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
