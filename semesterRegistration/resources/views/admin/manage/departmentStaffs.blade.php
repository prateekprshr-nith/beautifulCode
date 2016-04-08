@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-user"></span>
                        <strong> Department Staff members currently registered in the system</strong>
                    </div>
                    <div class="panel-body">
                        @if (count($departmentStaffs) > 0)
                                <!-- Current departmentStaffs list -->
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Department Id</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($departmentStaffs as $departmentStaff)
                                <tr>
                                    <td>{{ ++$count }}</td>
                                    <td>{{ $departmentStaff->id }}</td>
                                    <td>{{ $departmentStaff->name }}</td>
                                    <td>{{ $departmentStaff->email }}</td>
                                    <td>{{ $departmentStaff->dCode }}</td>
                                    <td>
                                        <form action="/admins/manage/departmentStaffs/{{$departmentStaff->id}}" method="POST">
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
                            No Department Staff member is currently registered in the system.
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Show departmentStaff registration form -->
    @yield('departmentStaffRegPanel')
@endsection