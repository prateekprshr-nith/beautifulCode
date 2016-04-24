@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-pushpin"></span>
                        <strong> Hostels currently entered in the database.</strong>
                    </div>
                    <div class="panel-body">
                        @if (count($hostels) > 0)
                                <!-- Current hostels list -->
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Hostel Id</th>
                                <th>Hostel Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($hostels as $hostel)
                                <tr>
                                    <td>{{ ++$count }}</td>
                                    <td>{{ $hostel->hostelId }}</td>
                                    <td>{{ $hostel->name }}</td>
                                    <td>
                                        <form action="/admins/manage/hostels/{{$hostel->hostelId}}" method="POST">
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
                            No Hostel is currently entered in the database.
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hostel creation form -->
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-plus"></span>
                        <strong> Add new hostel</strong>
                    </div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form class="form-horizontal" role="form" method="POST" action="/admins/manage/hostels"
                              accept-charset="UTF-8" id="hostelCreationForm">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <!-- Display Validation Errors -->
                            @include('common.errors')

                            <!-- First row Hostel Id-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="hostelId">Hostel Id</label>
                                <div class="col-md-6">
                                    <input required class="form-control" name="hostelId" type="text" id="hostelId">
                                </div>
                            </div>

                            <!-- Second row name-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="name">Hostel Name</label>
                                <div class="col-md-6">
                                    <input required class="form-control" name="name" type="text" id="name">
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