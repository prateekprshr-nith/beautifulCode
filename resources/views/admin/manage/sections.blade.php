@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-pushpin"></span>
                        <strong> Sections currently entered in the database.</strong>
                    </div>
                    <div class="panel-body">
                        @if (count($sections) > 0)
                        <!-- Current sections list -->
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Section Id</th>
                                    <th>Department Code</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($sections as $section)
                                <tr>
                                    <td>{{ ++$count }}</td>
                                    <td>{{ $section->sectionId }}</td>
                                    <td>{{ $section->dCode }}</td>
                                    <td>
                                        <form action="/admins/manage/sections/{{$section->sectionId}}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" class="btn btn-danger"
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
                            No Section is currently entered in the database.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section creation form -->
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-plus"></span>
                        <strong> Add new section</strong>
                    </div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form class="form-horizontal" role="form" method="POST" action="/admins/manage/sections"
                              accept-charset="UTF-8" id="sectionCreationForm">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <!-- Display Validation Errors -->
                            @include('common.errors')

                            <!-- First row Section Id-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="sectionId">Section Id</label>
                                <div class="col-md-6">
                                    <input required class="form-control" name="sectionId" type="text" id="sectionId">
                                </div>
                            </div>

                            <!-- Second row dName-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="department">Department Name</label>
                                <div class="col-md-6">
                                    <select required id="department" name="dCode" class="form-control">
                                        <option value="">Select a Department...</option>
                                        @foreach($departments as $department)
                                            <option value="{{$department->dCode}}">{{$department->dName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Third row create button-->
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button class="btn btn-primary" type="submit" id="createButton">
                                        <span class="glyphicon glyphicon-log-in"></span> Create
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection