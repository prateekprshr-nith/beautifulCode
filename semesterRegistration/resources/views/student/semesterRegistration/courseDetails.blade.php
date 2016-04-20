@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">

            <!-- Progress bar -->
            <div class="col-md-3 ">
                <h4 class="text-center text-primary">Current Progress</h4>

                <div class="progress">
                    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100" style="width: 66%;">
                        66%
                    </div>
                </div>
            </div>

            <!-- Panel -->
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-pencil"></span>
                        <strong> Step 3: Review the courses</strong>
                    </div>

                    <div class="panel-body">

                        <p class="text-left">
                            <strong>
                                You will study the following courses in this semester
                            </strong>
                        </p>

                        <!-- Current courses list -->
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Course Code</th>
                                    <th>Course Name</th>
                                    <th>L</th>
                                    <th>T</th>
                                    <th>P</th>
                                    <th>Hours</th>
                                    <th>Credits</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                    <tr>
                                        <td>{{ ++$count }}</td>
                                        <td>{{ $course->courseCode }}</td>
                                        <td>{{ $course->courseDetail->courseName }}</td>
                                        <td>{{ $course->courseDetail->lectures }}</td>
                                        <td>{{ $course->courseDetail->tutorials }}</td>
                                        <td>{{ $course->courseDetail->practicals }}</td>
                                        <td>{{ $course->courseDetail->hours }}</td>
                                        <td>{{ $course->courseDetail->credits }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Open elective and department elective selection form-->
                        <form method="post" action="/students/semesterRegistration/courseDetails" id="courseDetailsForm"
                              class="form-horizontal" accept-charset="UTF-8" enctype="multipart/form-data">
                            {{csrf_field()}}
                            {{method_field('PUT')}}

                            <!-- #TODO add content for open elective and department elective selection -->
                            <input type="submit" hidden id="submit">
                        </form>

                        <hr class="gradientHr col-md-11">

                        <p class="well well-sm col-md-12">
                            <span class="glyphicon glyphicon-alert"></span>
                            <strong>Tip:</strong> Please check all your details before clicking next. You won't be able
                            to come back to this step later on.
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