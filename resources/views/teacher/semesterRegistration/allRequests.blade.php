@extends('layouts.app')

@section('content')
    @if(Auth::guard('teacher')->user()->semNo != null)
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-th-list"></span> Student Registration Requests
                    </div>

                    <div class="panel-body">
                        <ul class="nav nav-tabs nav-justified">
                            <li role="presentation">
                                <a href="/teachers/semesterRegistration/studentRequests/new">
                                    New Requests <span class="badge">{{$requestCount['newCount']}}</span>
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="/teachers/semesterRegistration/studentRequests/pending">
                                    Pending Requests <span class="badge">{{$requestCount['pendingCount']}}</span>
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="/teachers/semesterRegistration/studentRequests/approved">
                                    Approved Requests <span class="badge">{{$requestCount['approvedCount']}}</span>
                                </a>
                            </li>
                            <li role="presentation" class="active">
                                <a href="/teachers/semesterRegistration/studentRequests/all">
                                    All Requests <span class="badge">{{$requestCount['totalCount']}}</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <br>

                    <!-- New requests list -->
                    <table class="table table-responsive">
                        @if($requests->isEmpty() || (count($requests)  == 1 && $requests[0]->step == 1))
                            <div class="well well-sm col-lg-6 col-md-offset-3">
                                <h5 class="text-center">No requests</h5>
                            </div>
                        @else
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Roll No.</th>
                                    <th>Teacher</th>
                                    <th>Accounts</th>
                                    <th>Library</th>
                                    <th>Hostel</th>
                                    <th>Chief warden</th>
                                    <th>Student Information</th>
                                    <th>Register</th>
                                    <th>Code</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requests as $request)
                                    @if($request->step != 1)
                                        <tr>
                                            <td>{{++$count}}</td>
                                            <td>{{$request->rollNo}}</td>
                                            <td>
                                                @if($request->feeReceipt == true)
                                                    @if($request->student->teacherRequest != null)
                                                        @if($request->student->teacherRequest->status === 'new')
                                                            Awaiting approval
                                                            {{-- */$feeStatus = 'new';/* --}}
                                                        @elseif($request->student->teacherRequest->status === 'pending')
                                                            Pending
                                                            {{-- */$feeStatus = 'pending';/* --}}
                                                        @else
                                                            Approved
                                                            {{-- */$feeStatus = 'approved';/* --}}
                                                        @endif
                                                    @else
                                                        Awaiting approval
                                                        {{-- */$feeStatus = 'new';/* --}}
                                                    @endif
                                                @else
                                                    <p class="text-info">Not applicable</p>
                                                @endif
                                            </td>
                                            <td>
                                                @if($request->feeReceipt == false)
                                                    @if($request->student->adminStaffRequest != null)
                                                        @if($request->student->adminStaffRequest->status === 'new')
                                                            Awaiting approval
                                                            {{-- */$feeStatus = 'new';/* --}}
                                                        @elseif($request->student->adminStaffRequest->status === 'pending')
                                                            Pending
                                                            {{-- */$feeStatus = 'pending';/* --}}
                                                        @else
                                                            Approved
                                                            {{-- */$feeStatus = 'approved';/* --}}
                                                        @endif
                                                    @else
                                                        Awaiting approval
                                                        {{-- */$feeStatus = 'new';/* --}}
                                                    @endif
                                                @else
                                                    <p class="text-info">Not applicable</p>
                                                @endif
                                            </td>
                                            <td>
                                                @if($request->student->libraryStaffRequest != null)
                                                    @if($request->student->libraryStaffRequest->status === 'new')
                                                        Awaiting approval
                                                        {{-- */$feeStatus = 'new';/* --}}
                                                    @elseif($request->student->libraryStaffRequest->status === 'pending')
                                                        Pending
                                                        {{-- */$libraryStatus = 'pending';/* --}}
                                                    @else
                                                        Approved
                                                        {{-- */$libraryStatus = 'approved';/* --}}
                                                    @endif
                                                @else
                                                    Awaiting approval
                                                    {{-- */$feeStatus = 'new';/* --}}
                                                @endif
                                            </td>
                                            <td>
                                                @if($request->hostler == true)
                                                    @if($request->student->hostelStaffRequest)
                                                        @if($request->student->hostelStaffRequest->status === 'new')
                                                            Awaiting approval
                                                            {{-- */$hostelStatus = 'new';/* --}}
                                                        @elseif($request->student->hostelStaffRequest->status === 'pending')
                                                            Pending
                                                            {{-- */$hostelStatus = 'pending';/* --}}
                                                        @else
                                                            Approved
                                                            {{-- */$hostelStatus = 'approved';/* --}}
                                                        @endif
                                                    @else
                                                        Awaiting approval
                                                        {{-- */$hostelStatus = 'new';/* --}}
                                                    @endif
                                                @else
                                                    <p class="text-info">Not applicable</p>
                                                @endif
                                            </td>
                                            <td>
                                                @if($request->hostler == false)
                                                    @if($request->student->chiefWardenStaffRequest)
                                                        @if($request->student->chiefWardenStaffRequest->status === 'new')
                                                            Awaiting approval
                                                            {{-- */$hostelStatus = 'new';/* --}}
                                                        @elseif($request->student->chiefWardenStaffRequest->status === 'pending')
                                                            Pending
                                                            {{-- */$hostelStatus = 'pending';/* --}}
                                                        @else
                                                            Approved
                                                            {{-- */$hostelStatus = 'approved';/* --}}
                                                        @endif
                                                    @else
                                                        Awaiting approval
                                                        {{-- */$hostelStatus = 'new';/* --}}
                                                    @endif
                                                @else
                                                    <p class="text-info">Not applicable</p>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-primary" data-toggle="modal"
                                                   data-target="#myModal" onclick='setImageSrc("feeReceiptImage",
                                                        "/teachers/semesterRegistration/studentRequests/feeReceipts/",
                                                        "{{$request->rollNo}}")' data-rollno="{{$request->rollNo}}">
                                                    <span class="glyphicon glyphicon-info-sign"></span> View student info
                                                </a>
                                            </td>
                                            <td>
                                                @if($request->student->currentStudentState->approved == true)
                                                    <span class="glyphicon glyphicon-ok"></span> Registered
                                                @elseif($feeStatus === 'approved' &&
                                                        $libraryStatus === 'approved' &&
                                                        $hostelStatus === 'approved')
                                                    <form method="post" action="/teachers/semesterRegistration/studentRequests/register">
                                                        {{csrf_field()}}
                                                        {{method_field('PATCH')}}

                                                        <input hidden name="rollNo" value="{{$request->rollNo}}">

                                                        <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('Are you sure?')">
                                                            <span class="glyphicon glyphicon-ok"></span> Register
                                                        </button>
                                                    </form>
                                                @else
                                                    <button disabled type="submit" class="btn btn-sm btn-primary" onclick="return confirm('Are you sure?')">
                                                        <span class="glyphicon glyphicon-ok"></span> Register
                                                    </button>
                                                @endif
                                            </td>
                                            <td class="text-primary">{{$request->student->currentStudentState->verificationCode}}</td>
                                            <td>
                                                <form method="post" action="/teachers/semesterRegistration/studentRequests/delete">
                                                    {{csrf_field()}}
                                                    {{method_field('DELETE')}}

                                                    <input hidden name="rollNo" value="{{$request->rollNo}}">

                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                        <span class="glyphicon glyphicon-remove"></span> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        @endif
                    </table>

                    <div class="text-center">{!! $requests->links() !!}</div>
                </div>
            </div>
        </div>
    </div>

        @include('teacher.partials.studentAndFeeInformationModal')
    @else
        <style>
            .element {
                position: relative;
                top: 50%;
                transform: translateY(10%);
            }
        </style>
        <div class="container element">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="jumbotron text-center">
                        <h3>Please <a href="/teachers/semesterRegistration/semester">register</a> as an incharge first. </h3>
                    </div>
                </div>
            </div>
        </div>
    @endif


@endsection