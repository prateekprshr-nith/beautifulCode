@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-user"></span>
                        <strong> Admin Staff members currently registered in the system</strong>
                    </div>
                    <div class="panel-body">
                        @if (count($adminStaffs) > 0)
                            <!-- Current adminStaffs list -->
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($adminStaffs as $adminStaff)
                                    <tr>
                                        <td>{{ ++$count }}</td>
                                        <td>{{ $adminStaff->id }}</td>
                                        <td>{{ $adminStaff->name }}</td>
                                        <td>{{ $adminStaff->email }}</td>
                                        <td>
                                            <form action="/admins/manage/adminStaffs/{{$adminStaff->id}}" method="POST">
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
                            No Admin Staff member is currently registered in the system.
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Show adminStaff registration form -->
    @yield('adminStaffRegPanel')
@endsection