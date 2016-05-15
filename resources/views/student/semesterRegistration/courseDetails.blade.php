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
                        <strong> Step 3: Review the courses and choose open electives if any</strong>
                    </div>

                    <div class="panel-body">

                        <p class="text-left">
                            <strong>
                                You will study the following courses in this semester
                            </strong>
                        </p>

                        <br>

                        <!-- Current courses list -->
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
                                @foreach ($courses as $course)
                                    <tr>
                                        <td>{{ ++$count }}</td>
                                        <td>{{ $course->courseCode }}</td>
                                        <td>{{ $course->courseName }}</td>
                                        <td>
                                            @if($course->openElective == true)
                                                Open elective
                                            @elseif($course->departmentElective == true)
                                                Department Elective
                                            @else
                                                No
                                            @endif
                                        </td>
                                        <td>{{ $course->lectures }}</td>
                                        <td>{{ $course->tutorials }}</td>
                                        <td>{{ $course->practicals }}</td>
                                        <td>{{ $course->credits }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Open elective and department elective selection form-->
                        <form method="post" action="/students/semesterRegistration/courseDetails/electives" id="courseDetailsForm"
                              class="form-horizontal" accept-charset="UTF-8" enctype="multipart/form-data">
                            {{csrf_field()}}
                            {{method_field('PUT')}}

                            <!-- Status for course in case student submits course without checking status-->
                            @if (session('status'))
                                <div class="alert alert-danger">
                                    {{ session('status') }}
                                </div>
                            @endif

                            @if(count($electiveCount) > 0)
                                @if($electiveCount[0]->openElectives + $electiveCount[0]->departmentElectives > 0)
                                    <hr class="gradientHr col-md-11">

                                    <!-- Grade and supplimentary information -->
                                    <p class="text-left">
                                        <strong>
                                            Plese choose elective subjects. Make sure to check vacant seats before moving on
                                            to next step.
                                        </strong>
                                    </p>

                                    <br>

                                    <!-- Display open elective selection form -->
                                    @for($i = 0; $i < $electiveCount[0]->openElectives; $i++)
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="oelective{{$i}}">Open Elective #{{$i + 1}}</label>
                                            <div class="col-md-4">
                                                <select required id="oelective{{$i}}" name="courseCode[]" class="form-control"
                                                        onchange="setBtnData(this, 'open', '{{$i}}')">

                                                    <option value="">Select a open elective...</option>

                                                    @foreach($openElectives as $openElective)
                                                        <option value="{{$openElective->courseCode}}">{{$openElective->courseCode}}: {{$openElective->courseName}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" disabled class="btn btn-sm btn-primary" id="ostatusBtn{{$i}}" data-course="" onclick="getElectiveInfo(this)">
                                                    <span class="glyphicon glyphicon-info-sign"></span> Check vacant seats
                                                </button>
                                            </div>
                                        </div>
                                    @endfor

                                    <!-- Display department elective selection form -->
                                    @for($i = 0; $i < $electiveCount[0]->departmentElectives; $i++)
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="delective{{$i}}">Department Elective #{{$i + 1}}</label>
                                            <div class="col-md-4">
                                                <select required id="delective{{$i}}" name="courseCode[]" class="form-control"
                                                        onchange="setBtnData(this, 'department', '{{$i}}')">

                                                    <option value="">Select a department elective...</option>

                                                    @foreach($departmentElectives as $departmentElective)
                                                        <option value="{{$departmentElective->courseCode}}">{{$departmentElective->courseCode}}: {{$departmentElective->courseName}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" disabled class="btn btn-sm btn-primary" id="dstatusBtn{{$i}}" data-course="" onclick="getElectiveInfo(this)">
                                                    <span class="glyphicon glyphicon-info-sign"></span> Check vacant seats
                                                </button>
                                            </div>
                                        </div>
                                    @endfor
                                @endif
                            @endif

                            <input type="submit" hidden id="submit">
                        </form>

                        <hr class="gradientHr col-md-11">

                        <p class="well well-sm col-md-12">
                            <span class="glyphicon glyphicon-alert"></span>
                            <strong>Tip:</strong> Please check all your details before clicking next. You won't be able to come back to this
                            step later on. You should fill this information carefully/legibly and correctly. In case any discrepancy is found
                            later on, you will be held solely responsible for the same.
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

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">
                        <span class="glyphicon glyphicon-info-sign"></span>
                        <strong> Elective Information <span id="id"></span></strong>
                    </h4>
                </div>
                <div class="modal-body text-center">
                    <h4>The elective <span id="electiveName"></span> <span id="electiveStatus"></span></h4>
                </div>
            </div>
        </div>
    </div>

    <script>

    </script>
@endsection