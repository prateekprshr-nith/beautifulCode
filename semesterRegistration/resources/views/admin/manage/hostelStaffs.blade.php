@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-user"></span>
                        <strong> Hostel Staff members currently registered in the system</strong>
                    </div>
                    <div class="panel-body">
                        @if (count($hostelStaffs) > 0)
                                <!-- Current hostelStaffs list -->
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Hostel Id</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($hostelStaffs as $hostelStaff)
                                <tr>
                                    <td>{{ ++$count }}</td>
                                    <td>{{ $hostelStaff->id }}</td>
                                    <td>{{ $hostelStaff->name }}</td>
                                    <td>{{ $hostelStaff->email }}</td>
                                    <td>{{ $hostelStaff->hostelId }}</td>
                                    <td>
                                        <form action="/admins/manage/hostelStaffs/{{$hostelStaff->id}}" method="POST">
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
                            No Hostel Staff member is currently registered in the system.
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Show hostelStaff registration form -->
    @yield('hostelStaffRegPanel')
@endsection