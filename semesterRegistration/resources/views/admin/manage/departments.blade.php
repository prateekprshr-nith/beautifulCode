@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-pushpin"></span>
                        <strong> Departments currently entered in the database.</strong>
                    </div>
                    <div class="panel-body">
                        @if (count($departments) > 0)
                            <!-- Current departments list -->
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Department Code</th>
                                    <th>Department Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($departments as $department)
                                    <tr>
                                        <td>{{ ++$count }}</td>
                                        <td>{{ $department->dCode }}</td>
                                        <td>{{ $department->dName }}</td>
                                        <td>
                                            <form action="/admins/manage/departments/{{$department->dCode}}" method="POST">
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
                            No Department is currently entered in the database.
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Department creation form -->
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-plus"></span>
                        <strong> Add new department</strong>
                    </div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form class="form-horizontal" role="form" method="POST" action="/admins/manage/departments"
                              accept-charset="UTF-8" id="departmentCreationForm">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <!-- Display Validation Errors -->
                            @include('common.errors')

                            <!-- First row Department Code-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="dCode">Department Code</label>
                                <div class="col-md-6">
                                    <input required class="form-control" name="dCode" type="text" id="dCode">
                                </div>
                            </div>

                            <!-- Second row dName-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="dName">Department Name</label>
                                <div class="col-md-6">
                                    <input required class="form-control" name="dName" type="text" id="dName">
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