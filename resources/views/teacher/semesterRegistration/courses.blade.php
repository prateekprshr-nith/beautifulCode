@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-edit"></span> Please enter the required details
                    </div>

                    <div class="panel-body">
                        <ul class="nav nav-tabs nav-justified">
                            <li role="presentation">
                                <a href="/teachers/semesterRegistration/semester">
                                    Choose semester
                                    @if(Auth::guard('teacher')->user()->semNo != null)
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @endif
                                </a>
                            </li>
                            @if(Auth::guard('teacher')->user()->semNo == null)
                                <li class="disabled" >
                                    <a href="/teachers/semesterRegistration/courses">Choose courses</a>
                                </li>
                            @else
                                <li class="active">
                                    <a href="/teachers/semesterRegistration/courses">
                                        Choose courses/electives
                                        @if(count($electiveCount) > 0)
                                            <span class="glyphicon glyphicon-ok"></span>
                                        @endif
                                    </a>
                                </li>
                            @endif
                        </ul>

                        <br>

                        <p class="text-left">
                            <strong>
                                Please update number of open electives and department electives for this semester.
                                Enter 0 (zero) if there are no electives.
                            </strong>
                        </p>
                        <br>
                        <form class="form-inline" role="form" method="POST" action="/teachers/semesterRegistration/electives"
                              accept-charset="UTF-8" id="electiveForm">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            @if (session('status'))
                                <div class="row">
                                    <div class="alert alert-success col-md-4 col-md-offset-4">
                                        {{ session('status') }}
                                    </div>
                                </div>
                            @endif

                            @include('common.errors')

                            <div class="form-group">
                                <label for="openElectives">Open electives</label>
                                @if(count($electiveCount) > 0)
                                    <input type="number" required min="0" class="form-control" id="openElectives" placeholder="0"
                                           name="openElectives" value="{{$electiveCount[0]->openElectives}}">
                                @else
                                    <input type="number" required min="0" class="form-control" id="openElectives" placeholder="0"
                                           name="openElectives">
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="departmentElectives">Department electives</label>
                                @if(count($electiveCount) > 0)
                                    <input type="number" required min="0" class="form-control" id="departmentElectives" placeholder="0"
                                           name="departmentElectives" value="{{$electiveCount[0]->departmentElectives}}">
                                @else
                                    <input type="number" required min="0" class="form-control" id="departmentElectives" placeholder="0"
                                           name="departmentElectives">
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <span class="glyphicon glyphicon-plus"></span> Update
                            </button>
                        </form>

                        <hr class="gradientHr col-md-11">

                        @if (count($courses) > 0)
                            <!-- Current courses list -->
                            <table class="table table-hover">
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
                                        <th></th>
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
                        @else
                            <div class="well well-sm text-center text-primary col-md-12">
                                No Course is currently present in the database.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection