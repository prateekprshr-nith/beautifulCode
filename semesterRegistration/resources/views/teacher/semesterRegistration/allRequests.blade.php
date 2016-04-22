@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-th-list"></span> Student Registration Requests
                    </div>

                    <div class="panel-body">
                        <ul class="nav nav-tabs nav-justified">
                            <li role="presentation">
                                <a href="/teachers/semesterRegistration/studentRequests/new">New Requests</a>
                            </li>
                            <li role="presentation">
                                <a href="/teachers/semesterRegistration/studentRequests/pending">Pending Requests</a>
                            </li>
                            <li role="presentation">
                                <a href="/teachers/semesterRegistration/studentRequests/approved">Approved Requests</a>
                            </li>
                            <li role="presentation" class="active">
                                <a href="/teachers/semesterRegistration/studentRequests/all">All Requests</a>
                            </li>
                        </ul>
                    </div>

                    <br>

                    <!-- New requests list -->
                    <table class="table table-responsive">
                        @if($requests->isEmpty())
                            <div class="well well-sm col-lg-6 col-md-offset-3">
                                <h5 class="text-center">No requests</h5>
                            </div>
                        @else
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Roll No.</th>
                                    <th>Teacher</th>
                                    <th>Accounts branch</th>
                                    <th>Library</th>
                                    <th>Hostel</th>
                                    <th>Chief warden's office</th>
                                    <th>Register</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requests as $request)
                                    <tr>
                                        <td>{{++$count}}</td>
                                        <td>{{$request->rollNo}}</td>
                                        <td>
                                            @if($request->feeReceipt == true)
                                                @if($request->student->teacherRequest->status === 'new')
                                                    Awaiting approval
                                                @elseif($request->student->teacherRequest->status === 'pending')
                                                    Pending
                                                @else
                                                    Approved
                                                @endif
                                            @else
                                                Not applicable
                                            @endif
                                        </td>
                                        <td>
                                            @if($request->feeReceipt == false)
                                                @if($request->student->adminStaffRequest->status === 'new')
                                                    Awaiting approval
                                                @elseif($request->student->adminStaffRequest->status === 'pending')
                                                    Pending
                                                @else
                                                    Approved
                                                @endif
                                            @else
                                                Not applicable
                                            @endif
                                        </td>
                                        <td>
                                            @if($request->student->libraryStaffRequest->status === 'new')
                                                Awaiting approval
                                            @elseif($request->student->libraryStaffRequest->status === 'pending')
                                                Pending
                                            @else
                                                Approved
                                            @endif
                                        </td>
                                        <td>
                                            @if($request->hostler == true)
                                                @if($request->student->hostelStaffRequest->status === 'new')
                                                    Awaiting approval
                                                @elseif($request->student->hostelStaffRequest->status === 'pending')
                                                    Pending
                                                @else
                                                    Approved
                                                @endif
                                            @else
                                                Not applicable
                                            @endif
                                        </td>
                                        <td>
                                            @if($request->hostler == false)
                                                @if($request->student->chiefWardenStaffRequest->status === 'new')
                                                    Awaiting approval
                                                @elseif($request->student->chiefWardenRequest->status === 'pending')
                                                    Pending
                                                @else
                                                    Approved
                                                @endif
                                            @else
                                                Not applicable
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-primary" onclick="return confirm('Are you sure?')">
                                                <span class="glyphicon glyphicon-ok"></span> Register
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection