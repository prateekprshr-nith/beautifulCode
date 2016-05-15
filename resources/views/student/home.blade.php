@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-info-sign"></span>
                        <strong> Personal Information</strong>
                    </div>

                    <div class="panel-body">
                        <img src="{{ url('/students/image') }}" id="profileImage" class="img-thumbnail col-md-2"
                             height="200" width="200" alt="Cinque Terre" onerror="loadAvatarIcon('profileImage')">
                        <div class="col-md-10">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <td><strong>Name</strong></td>
                                    <td>{{Auth::guard('student')->user()->name}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Father's name</strong></td>
                                    <td>{{Auth::guard('student')->user()->fatherName}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Mother's name</strong></td>
                                    <td>{{Auth::guard('student')->user()->motherName}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Roll No.</strong></td>
                                    <td>{{Auth::guard('student')->user()->rollNo}}</td>
                                </tr><tr>
                                    <td><strong>Department</strong></td>
                                    <td>{{Auth::guard('student')->user()->department->dName}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Section</strong></td>
                                    <td>{{Auth::guard('student')->user()->sectionId}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Semester</strong></td>
                                    <td>{{Auth::guard('student')->user()->semNo}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Date of Birth</strong></td>
                                    <td>{{Auth::guard('student')->user()->dob}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td>{{Auth::guard('student')->user()->email}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Phone no</strong></td>
                                    <td>{{Auth::guard('student')->user()->phoneNo}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Current Address</strong></td>
                                    <td>{{Auth::guard('student')->user()->currentAddress}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Permanent Address</strong></td>
                                    <td>{{Auth::guard('student')->user()->permanentAddress}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
