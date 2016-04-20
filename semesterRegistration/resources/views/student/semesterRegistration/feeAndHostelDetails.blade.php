@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">

            <!-- Progress bar -->
            <div class="col-md-3 ">
                <h4 class="text-center text-primary">Current Progress</h4>

                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                        33%
                    </div>
                </div>
            </div>

            <!-- Panel -->
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-pencil"></span>
                        <strong> Step 2: Check and update your fee and hostel details</strong>
                    </div>

                    <!--
                        If student has fee receipt or he is a hostler, show him the
                        corresponding forms, or else display informative text.
                    -->
                    <form method="post" action="/students/semesterRegistration/feeAndHostelDetails" id="feeAndHostelDetailsForm"
                          class="form-horizontal" accept-charset="UTF-8" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('PUT')}}

                        @if($currentStudentState->feeReceipt == false &&
                            $currentStudentState->hostler == false)

                            <div class="panel-body">

                                <!-- FeeReceipt information -->
                                <p class="text-left">
                                    <strong>
                                        Since you don't have fee receipt or don't have your roll no. and name on it,
                                        you don't need to upload the image of fee receipt. Your fee payment details will
                                        be checked by accounts branch.
                                    </strong>
                                </p>

                                <hr class="gradientHr col-md-11">

                                <!-- Hostel information -->
                                <p class="text-left">
                                    <strong>
                                        Since you are not a hostler, your details will be verified by chief warden office.
                                    </strong>
                                </p>

                                <hr class="gradientHr col-md-11">

                                <p class="well well-sm col-md-12">
                                    <span class="glyphicon glyphicon-alert"></span>
                                    <strong>Tip:</strong> Please check all your details before clicking next. You won't be able to come back to this
                                    step later on.
                                </p>

                                <input type="submit" hidden id="submit">
                            </div>

                            <div class="panel-footer text-right">
                                <label for="submit" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure?')">
                                    <span class="glyphicon glyphicon-arrow-right"></span> Next step
                                </label>
                            </div>

                        @else
                            <div class="panel-body">

                                    <div class="col-lg-12">
                                        @include('common.errors')
                                    </div>

                                    <!-- FeeReceipt information -->
                                    @if($currentStudentState->feeReceipt == true)
                                        <p class="text-left">
                                            <strong>
                                                Please upload a clear image of your fee receipt
                                            </strong>
                                        </p>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="image">Image</label>
                                            <div class="col-md-6">
                                                <input required class="form-control" name="image" type="file" id="image"
                                                       onchange="validateFileSize('feeAndHostelDetailsForm', 'image')">
                                            </div>
                                        </div>
                                    @else
                                        <p class="text-left">
                                            <strong>
                                                Since you don't have fee slip, you don't need to upload fee slip.
                                                Your fee payment details will be checked by accounts branch.
                                            </strong>
                                        </p>
                                    @endif

                                    <hr class="gradientHr col-md-11">

                                    <!-- Hostel information -->
                                    @if($currentStudentState->hostler == true)
                                        <p class="text-left">
                                            <strong>
                                                Please select the hostel which you had occupied in the previous semester
                                            </strong>
                                        </p>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="hostelId">Hostel</label>
                                            <div class="col-md-6">
                                                <select required id="hostelId" name="hostelId" class="form-control">
                                                    <option value="">Select a Hostel...</option>
                                                    @foreach($hostels as $hostel)
                                                        <option value="{{$hostel->hostelId}}">{{$hostel->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @else
                                        <p class="text-left">
                                            <strong>
                                                Since you were not a hostler in the previous semester, you don't need to choose
                                                a hostel. Your dues will be checked by chief warden office.
                                            </strong>
                                        </p>
                                    @endif

                                    <hr class="gradientHr col-md-11">

                                    <p class="well well-sm col-md-12">
                                        <span class="glyphicon glyphicon-alert"></span>
                                        <strong>Tip:</strong> Please check all your details before clicking next. You won't be
                                        able to come back to this step later on.
                                    </p>

                                    <input type="submit" hidden id="submit">
                            </div>

                            <div class="panel-footer text-right">
                                <label for="submit" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure?')">
                                    <span class="glyphicon glyphicon-arrow-right"></span> Next step
                                </label>

                            </div>

                        @endif

                    </form>
                </div>
            </div>

        </div>

    </div>
@endsection