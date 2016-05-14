@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">

            <!-- Progress bar -->
            <div class="col-md-3 ">
                <h4 class="text-center text-primary">Current Progress</h4>

                <div class="progress">
                    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                        100%
                    </div>
                </div>
            </div>

            <!-- Panel -->
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-time"></span>
                        <strong>Your registration status</strong>
                    </div>

                    <div class="panel-body">

                        @if(count($allocatedElectives) > 0)
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-success">
                                    <div class="panel-heading" role="tab" id="headingOne">
                                            <a role="button"  class="text-success" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                <span class="glyphicon glyphicon-book"></span> Electives allocated to you
                                                <span class="caret"></span>
                                            </a>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                        <table class="table table-hover responsive">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Course Code</th>
                                                <th>Course Name</th>
                                                <th>Elective</th>
                                                <th>L</th>
                                                <th>T</th>
                                                <th>P</th>
                                                <th>Credits</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($allocatedElectives as $allocatedElective)
                                                <tr>
                                                    <td>{{ ++$count }}</td>
                                                    <td>{{ $allocatedElective->courseCode }}</td>
                                                    <td>{{ $allocatedElective->course->courseName }}</td>
                                                    <td>
                                                        @if($allocatedElective->course->openElective == true)
                                                            Open elective
                                                        @elseif($allocatedElective->course->departmentElective == true)
                                                            Department Elective
                                                        @else
                                                            No
                                                        @endif
                                                    </td>
                                                    <td>{{ $allocatedElective->course->lectures }}</td>
                                                    <td>{{ $allocatedElective->course->tutorials }}</td>
                                                    <td>{{ $allocatedElective->course->practicals }}</td>
                                                    <td>{{ $allocatedElective->course->credits }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <hr class="gradientHr col-md-11">
                        @endif

                        <!-- Display Validation Errors -->
                        @include('common.errors')

                        <!-- Fee status panel -->
                        <div class=" col-md-4">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <span class="glyphicon glyphicon-info-sign"></span> Fee payment approval status
                                </div>
                                <div class="panel-body">
                                    <p class="text-center">
                                        @if($currentStudentState->feeReceipt == true)
                                            Your request has been sent to the teacher for approval.
                                            {{-- */$feeStatus = Auth::guard('student')->user()->teacherRequest->status;/* --}}
                                            {{-- */$feeRemarks = Auth::guard('student')->user()->teacherRequest->remarks;/* --}}
                                        @else
                                            Your request has been sent to accounts branch for approval.
                                            {{-- */$feeStatus = Auth::guard('student')->user()->adminStaffRequest->status;/* --}}
                                            {{-- */$feeRemarks = Auth::guard('student')->user()->adminStaffRequest->remarks;/* --}}
                                        @endif
                                    </p>
                                </div>

                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <strong>Status: </strong>
                                        @if($feeStatus === 'new')
                                            Awaiting approval <span class="glyphicon glyphicon-refresh"></span>
                                        @elseif($feeStatus === 'pending')
                                            Request pending, see remarks <span class="glyphicon glyphicon-warning-sign"></span>
                                        @else
                                            Approved <span class="glyphicon glyphicon-check"></span>
                                        @endif
                                    </li>

                                    <li class="list-group-item">
                                        <strong>Remarks:</strong>
                                        {{$feeRemarks}}
                                    </li>

                                    @if($currentStudentState->feeReceipt == true &&
                                        $feeStatus === 'pending')
                                        <li class="list-group-item text-center">
                                            <button class="btn btn-sm btn-primary"  data-toggle="modal"
                                                    data-target="#myModal">
                                                <span class="glyphicon glyphicon-refresh"></span> Re-upload fee receipt
                                            </button>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>

                        <!-- Library status panel -->
                        <div class=" col-md-4">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <span class="glyphicon glyphicon-info-sign"></span> Library approval status
                                </div>
                                <div class="panel-body">
                                    <p class="text-center">
                                        Your request has been sent to library for approval.
                                        {{-- */$libraryStatus = Auth::guard('student')->user()->libraryStaffRequest->status;/* --}}
                                        {{-- */$libraryRemarks = Auth::guard('student')->user()->libraryStaffRequest->remarks;/* --}}
                                    </p>
                                </div>

                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <strong>Status: </strong>
                                        @if($libraryStatus === 'new')
                                            Awaiting approval <span class="glyphicon glyphicon-refresh"></span>
                                        @elseif($libraryStatus === 'pending')
                                            Request pending, see remarks <span class="glyphicon glyphicon-warning-sign"></span>
                                        @else
                                            Approved <span class="glyphicon glyphicon-check"></span>
                                        @endif
                                    </li>

                                    <li class="list-group-item">
                                        <strong>Remarks:</strong>
                                        {{$libraryRemarks}}
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Hostel status panel -->
                        <div class=" col-md-4">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <span class="glyphicon glyphicon-info-sign"></span> Hostel approval status
                                </div>
                                <div class="panel-body">
                                    <p class="text-center">
                                        @if($currentStudentState->hostler == true)
                                            Your request has been sent to {{Auth::guard('student')->user()->hostelStaffRequest->hostel->name}}
                                            for approval.
                                            {{-- */$hostelStatus = Auth::guard('student')->user()->hostelStaffRequest->status;/* --}}
                                            {{-- */$hostelRemarks = Auth::guard('student')->user()->hostelStaffRequest->remarks;/* --}}
                                        @else
                                            Your request has been sent to chief warden's office for approval.
                                            {{-- */$hostelStatus = Auth::guard('student')->user()->chiefWardenStaffRequest->status;/* --}}
                                            {{-- */$hostelRemarks = Auth::guard('student')->user()->chiefWardenStaffRequest->remarks;/* --}}
                                        @endif
                                    </p>
                                </div>

                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <strong>Status: </strong>
                                        @if($hostelStatus === 'new')
                                            Awaiting approval <span class="glyphicon glyphicon-refresh"></span>
                                        @elseif($hostelStatus === 'pending')
                                            Request pending, see remarks <span class="glyphicon glyphicon-warning-sign"></span>
                                        @else
                                            Approved <span class="glyphicon glyphicon-check"></span>
                                        @endif
                                    </li>

                                    <li class="list-group-item">
                                        <strong>Remarks:</strong>
                                        {{$hostelRemarks}}
                                    </li>
                                </ul>
                            </div>
                        </div>

                        @if($feeStatus === 'approved' && $libraryStatus === 'approved' && $hostelStatus === 'approved')

                            <hr class="gradientHr col-md-11">

                            @if($currentStudentState->approved == true)
                                <div class="row">
                                    <p class="col-md-12 text-center">
                                        <strong>
                                            You have been successfully registered. Your registration code is </strong>
                                            <span class="text-info">{{Auth::guard('student')->user()->currentStudentState->verificationCode}}</span>

                                    </p>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 col-md-offset-4 text-center">
                                        <!-- #TODO Add form download link here -->
                                        <a href="#" class="btn btn-primary">
                                            <span class="glyphicon glyphicon-download"></span> Download regisrtaion form
                                        </a>
                                    </div>
                                </div>

                                <hr class="gradientHr col-md-11">

                                <p class="well well-sm col-md-12">
                                    <span class="glyphicon glyphicon-alert"></span>
                                    <strong>Tip:</strong> Please take a printout of your registration form, attach your
                                    fee slip with it, attach your passport size photo if it is not clear in the form, and
                                    submit it to the registration incharge of your semester.
                                </p>
                            @else
                                <div class="col-md-6 col-md-offset-3 text-center">
                                    <h4>Awaiting final approval from teacher.</h4>
                                </div>
                            @endif
                        @endif

                    </div>
                </div>
            </div>

        </div>

    </div>

    @if($currentStudentState->feeReceipt == true && $feeStatus === 'pending')
        <!-- Image re-upload Modal form -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">
                            <span class="glyphicon glyphicon-plus"></span>
                            <strong> Re-upload a clear image of your fee receipt</strong>
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form" method="POST" action="/students/semesterRegistration/reUploadFeeReceipt"
                              accept-charset="UTF-8" id="updateInfoForm" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}


                            <div class="form-group">
                                <label class="col-md-2 control-label" for="image">Image</label>
                                <div class="col-md-8">
                                    <input required class="file-loading" name="image" type="file"
                                           id="image">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).on('ready', function() {
                $("#image").fileinput({
                    initialPreview: [
                    ],
                    overwriteInitial: false,
                    maxFileSize: 2048,
                    initialCaption: ""
                });
            });
        </script>
    @endif

@endsection