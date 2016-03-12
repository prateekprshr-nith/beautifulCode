@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Manage users</strong></div>

                <div class="panel-body">
                    <div class="btn-group btn-group-justified">
                        <a href="/admins/manage/teachers" class="btn btn-primary">
                            <span class="glyphicon glyphicon-user"></span> Manage Teachers
                        </a>
                        <a href="/admins/manage/hostelStaffs" class="btn btn-default">
                            <span class="glyphicon glyphicon-user"></span> Manage Hostel Staff
                        </a>
                        <a href="/admins/manage/adminStaffs" class="btn btn-primary">
                            <span class="glyphicon glyphicon-user"></span> Manage Admin Staff
                        </a>
                        <a href="/admins/manage/libraryStaffs" class="btn btn-default">
                            <span class="glyphicon glyphicon-user"></span> Manage Library Staff
                        </a>
                        <a href="/admins/manage/students" class="btn btn-primary">
                            <span class="glyphicon glyphicon-user"></span> Manage Students
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
