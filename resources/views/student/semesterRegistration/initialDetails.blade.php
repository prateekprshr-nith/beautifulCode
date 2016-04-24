@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">

            <!-- Progress bar -->
            <div class="col-md-3 ">
                <h4 class="text-center text-primary">Current Progress</h4>

                <div class="progress">
                    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em;">
                        0%
                    </div>
                </div>
            </div>

            <!-- Panel -->
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-pencil"></span>
                        <strong> Step 1: Check your information and fill initial details</strong>
                    </div>

                    <div class="panel-body">

                        <img src="{{ url('/students/image') }}" id="profileImage" class="img-thumbnail col-md-2"
                             height="200" width="200" alt="Cinque Terre" onerror="loadAvatarIcon('profileImage')">

                        <!-- Personal details -->
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
                                </tr>
                                <tr>
                                    <td><strong>Registration No.</strong></td>
                                    <td>{{Auth::guard('student')->user()->registrationNo}}</td>
                                </tr>
                                <tr>
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

                        <div class="col-md-2 col-md-offset-9">
                            <a href="/students/updateInfo" class="btn btn-sm btn-primary">
                                <span class="glyphicon glyphicon-refresh"></span> Update Details
                            </a>
                        </div>

                        <hr class="gradientHr col-md-11">

                        <!-- Initial details form-->
                        <form method="post" action="/students/semesterRegistration/initialDetails" class="form-horizontal">
                            {{method_field('PUT')}}
                            {{csrf_field()}}

                            <div class="col-lg-12">
                                @include('common.errors')
                            </div>

                            <!-- First row semester-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="semNo">Semester for registration</label>
                                <div class="col-md-6">
                                    <input required class="form-control" name="semNo" type="number" max="10"
                                           min="{{Auth::guard('student')->user()->semNo + 1}}" id="semNo"
                                           value="{{Auth::guard('student')->user()->semNo + 1}}">
                                </div>
                            </div>

                            <hr class="gradientHr col-md-11">

                            <!-- Grade and supplimentary information -->
                            <p class="text-left"><strong>Plese enter grades and supplementaries</strong> <i>(if any; write course codes seprated
                                    with comma eg: CS-101,CS-102)</i><strong> of previous semesters in the form below: </strong></p>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Semester</th>
                                        <th>SGPI</th>
                                        <th>CGPI</th>
                                        <th>Supplementaries <i>(if any)</i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for($semNo = 1; $semNo <= Auth::guard('student')->user()->semNo; $semNo++)
                                        <tr>
                                            <td>{{ $semNo }}</td>
                                            <td>
                                                <div class="input-group input-group-sm col-md-5">
                                                    <input required class="form-control" type="text" name="sgpi[]">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group input-group-sm col-md-5">
                                                    <input required class="form-control" type="text" name="cgpi[]">
                                                </div>
                                            </td>
                                            <td>
                                                <textarea class="form-control verticalAlign" rows="1" cols="50" name="supplementaries[]"></textarea>
                                            </td>

                                        </tr>
                                    @endfor
                                </tbody>
                            </table>

                            <hr class="gradientHr col-md-11">

                            <!-- Fee and hostel details -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="feeReceipt">
                                    Do you have fee receipt with your name and roll no. clearly printed on it?
                                </label>
                                <div class="col-md-6">
                                    <label class="radio-inline">
                                        <input required type="radio" name="feeReceipt" id="feeReceipt" value="yes">yes
                                    </label>
                                    <label class="radio-inline">
                                        <input required type="radio" name="feeReceipt" id="feeReceipt" value="no">no
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="hostler">
                                    Were your a hostler in previous semester?
                                </label>
                                <div class="col-md-6">
                                    <label class="radio-inline">
                                        <input required type="radio" name="hostler" id="hostler" value="yes">yes
                                    </label>
                                    <label class="radio-inline">
                                        <input required type="radio" name="hostler" id="hostler" value="no">no
                                    </label>
                                </div>
                            </div>

                            <input type="submit" hidden id="submit">
                        </form>

                        <hr class="gradientHr col-md-11">

                        <p class="well well-sm col-md-12">
                            <span class="glyphicon glyphicon-alert"></span>
                            <strong>Tip:</strong> Please check all your details before clicking next. You won't be able to come back to this
                            step later on.
                        </p>

                    </div>

                    <div class="panel-footer text-right">
                        <label for="submit" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure?')">
                            <span class="glyphicon glyphicon-arrow-right"></span> Next step
                        </label>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection