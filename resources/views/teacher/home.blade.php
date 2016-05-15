@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-info-sign"></span>
                        <strong> Personal Information</strong>
                    </div>

                    <div class="panel-body">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <td><strong>Name</strong></td>
                                <td>{{Auth::guard('teacher')->user()->name}}</td>
                            </tr>
                            <tr>
                                <td><strong>ID</strong></td>
                                <td>{{Auth::guard('teacher')->user()->facultyId}}</td>
                            </tr>
                            <tr>
                                <td><strong>Department</strong></td>
                                <td>{{Auth::guard('teacher')->user()->department->dName}}</td>
                            </tr>
                            <tr>
                                <td><strong>Office address</strong></td>
                                <td>{{Auth::guard('teacher')->user()->office}}</td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td>{{Auth::guard('teacher')->user()->email}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
