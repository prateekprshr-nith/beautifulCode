@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-user"></span>
                        <strong> Chief Warden staff members currently registered in the system</strong>
                    </div>
                    <div class="panel-body">
                        @if (count($chiefWardenStaffs) > 0)
                            <!-- Current chiefWardenStaffs list -->
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
                                @foreach ($chiefWardenStaffs as $chiefWardenStaff)
                                    <tr>
                                        <td>{{ ++$count }}</td>
                                        <td>{{ $chiefWardenStaff->id }}</td>
                                        <td>{{ $chiefWardenStaff->name }}</td>
                                        <td>{{ $chiefWardenStaff->email }}</td>
                                        <td>
                                            <form action="/admins/manage/chiefWardenStaffs/{{$chiefWardenStaff->id}}" method="POST">
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
                            No Chief Warden member is currently registered in the system.
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Show chiefWardenStaff registration form -->
    @yield('chiefWardenStaffRegPanel')
@endsection