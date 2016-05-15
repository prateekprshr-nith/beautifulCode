@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-user"></span>
                        <strong> Students currently registered in the system</strong>
                    </div>
                        <div class="panel-body">
                            @if (count($students) > 0)
                                <!-- Current students list -->
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Roll No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Deparment Code</th>
                                            <th>Verified</th>
                                            <th>Verify</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ ++$count }}</td>
                                            <td>{{ $student->rollNo }}</td>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td>{{ $student->dCode }}</td>
                                            <td>
                                                @if($student->verified)
                                                    Yes
                                                    {{-- */$disabled= 'disabled';/* --}}
                                                @else
                                                    No
                                                    {{-- */$disabled= '';/* --}}
                                                @endif
                                            </td>
                                            <td>
                                                <form action="/admins/manage/students/{{$student->rollNo}}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('PUT') }}

                                                <button type="submit" class="btn btn-primary" {{$disabled}}
                                                        onclick="return confirm('Are you sure?')">
                                                    <span class="glyphicon glyphicon-check"></span> Verify
                                                </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="/admins/manage/students/{{$student->rollNo}}" method="POST">
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
                                No students are currently registered in the system.
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection