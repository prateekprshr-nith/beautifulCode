@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-user"></span>
                        <strong> Teachers currently registered in the system</strong>
                    </div>
                        <div class="panel-body">
                            @if (count($teachers) > 0)
                                <!-- Current teachers list -->
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Faculty Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Deparment Code</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($teachers as $teacher)
                                            <tr>
                                                <td>{{ ++$count }}</td>
                                                <td>{{ $teacher->facultyId }}</td>
                                                <td>{{ $teacher->name }}</td>
                                                <td>{{ $teacher->email }}</td>
                                                <td>{{ $teacher->dCode}}</td>
                                                <td>
                                                    <form action="/admins/manage/teachers/{{$teacher->facultyId}}" method="POST">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}

                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                                            <span class="glyphicon glyphicon-remove"></span> Remove
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                No teachers are currently registered in the system.
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- Show teacher registration form -->
    @yield('teacherRegPanel')
@endsection