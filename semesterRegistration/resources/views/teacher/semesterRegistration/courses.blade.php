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
                        <nav>
                            <ul class="pager">
                                <li>
                                    <a href="/teachers/semesterRegistration/semester">
                                        Choose semester
                                        @if(Auth::guard('teacher')->user()->semNo != null)
                                            <span class="glyphicon glyphicon-ok"></span>
                                        @endif
                                    </a>
                                </li>
                                @if(Auth::guard('teacher')->user()->semNo == null)
                                    <li class="disabled">
                                        <a href="/teachers/semesterRegistration/courses">
                                            Choose courses
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <a href="/teachers/semesterRegistration/courses">Choose courses</a>
                                    </li>
                                @endif
                            </ul>
                        </nav>

                        <div class="panel-body">
                            @if (count($availableCourses) > 0)
                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <!-- Display Validation Errors -->
                                @include('common.errors')

                                <!-- Current availableCourses list -->
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
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($availableCourses as $availableCourse)
                                            <tr>
                                                <td>{{ ++$count }}</td>
                                                <td>{{ $availableCourse->courseCode }}</td>
                                                <td>{{ $availableCourse->courseDetail->courseName }}</td>
                                                <td>{{ $availableCourse->courseDetail->lectures }}</td>
                                                <td>{{ $availableCourse->courseDetail->tutorials }}</td>
                                                <td>{{ $availableCourse->courseDetail->practicals }}</td>
                                                <td>{{ $availableCourse->courseDetail->hours }}</td>
                                                <td>{{ $availableCourse->courseDetail->credits }}</td>
                                                <td>
                                                    <form action="/teachers/semesterRegistration/courses" method="POST">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <input hidden name="courseCode" value="{{ $availableCourse->courseCode }}">

                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Are you sure?')">
                                                            <span class="glyphicon glyphicon-remove"></span> Remove
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="well well-sm text-center text-primary ">
                                    No Course is currently selected. Please select courses.
                                </div>
                            @endif

                        </div>

                        <form class="form-horizontal" role="form" method="POST" action="/teachers/semesterRegistration/courses"
                              accept-charset="UTF-8" id="semesterForm">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            @include('common.errors')

                            <label class="col-md-2 control-label" for="department">Course</label>

                            <div class="col-md-8">
                                <select required id="course" name="courseCode" class="form-control">
                                    <option value="">Select a Course...</option>
                                    @foreach($courses as $course)
                                        <option value="{{$course->courseCode}}">{{$course->courseCode}} : {{$course->courseName}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <button class="btn btn-sm btn-primary" type="submit">
                                    <span class="glyphicon glyphicon-plus"></span> Add
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection