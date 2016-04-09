@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p class="panel-title pull-left">
                            <span class="glyphicon glyphicon-pushpin"></span>
                            <strong> Courses currently present in the database</strong>
                            ({{$dCode}})
                        </p>

                        <button class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#myModal">
                            <span class="glyphicon glyphicon-plus"></span> Add a course
                        </button>

                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        @if (count($courses) > 0)
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <!-- Display Validation Errors -->
                            @include('common.errors')

                            <!-- Current courses list -->
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Course Code</th>
                                    <th>Course Name</th>
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
                                            <form action="/departmentStaffs/home" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <input hidden name="courseCode" value="{{ $course->courseCode }}">

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
                            No Course is currently entered in the database.
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Course creation form -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">
                        <span class="glyphicon glyphicon-plus"></span>
                        <strong> Add new course</strong>
                    </h4>
                </div>
                <form class="form-horizontal" role="form" method="POST" action="/departmentStaffs/home"
                      accept-charset="UTF-8" id="courseCreationForm">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <!-- First row Course Code-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="courseCode">Course Code</label>
                            <div class="col-md-6">
                                <input required class="form-control" name="courseCode" type="text" id="courseCode">
                            </div>
                        </div>

                        <!-- Second row courseName-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="courseName">Course Name</label>
                            <div class="col-md-6">
                                <input required class="form-control" name="courseName" type="text" id="courseName">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit"  class="btn btn-primary" id="createButton">
                            <span class="glyphicon glyphicon-log-in"></span> Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection