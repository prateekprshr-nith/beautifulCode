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
                            <li role="presentation" class="active">
                                <a href="/hostelStaffs/semesterRegistration/studentRequests/new">
                                    New Requests <span class="badge">{{$requestCount['newCount']}}</span>
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="/hostelStaffs/semesterRegistration/studentRequests/pending">
                                    Pending Requests <span class="badge">{{$requestCount['pendingCount']}}</span>
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="/hostelStaffs/semesterRegistration/studentRequests/approved">
                                    Approved Requests <span class="badge">{{$requestCount['approvedCount']}}</span>
                                </a>
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
                                    <th>Student Information</th>
                                    <th>Approve</th>
                                    <th>Keep on hold</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requests as $request)
                                    <tr>
                                        <td>{{++$count}}</td>
                                        <td>{{$request->rollNo}}</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-primary" data-toggle="modal"
                                               data-target="#myModal" data-rollno="{{$request->rollNo}}">
                                                <span class="glyphicon glyphicon-info-sign"></span> View student info
                                            </a>
                                        </td>
                                        <td>
                                            <form method="post" action="/hostelStaffs/semesterRegistration/studentRequests/approve">
                                                {{method_field('PATCH')}}
                                                {{csrf_field()}}

                                                <input hidden name="rollNo" value="{{$request->rollNo}}">

                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                    <span class="glyphicon glyphicon-ok"></span> Approve
                                                </button>
                                            </form>
                                        </td>
                                        <form method="post" action="/hostelStaffs/semesterRegistration/studentRequests/hold">
                                            {{method_field('PATCH')}}
                                            {{csrf_field()}}

                                            <input hidden name="rollNo" value="{{$request->rollNo}}">

                                            <td>
                                                <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('Are you sure?')">
                                                    <span class="glyphicon glyphicon-pause"></span> Keep on hold
                                                </button>
                                            </td>
                                            <td>
                                                <textarea name="remarks" required class="form-control verticalAlign remark" rows="1"></textarea>
                                            </td>
                                        </form>
                                    </tr>
                                @endforeach
                            </tbody>
                        @endif
                    </table>

                    <div class="text-center">{!! $requests->links() !!}</div>
                </div>
            </div>
        </div>
    </div>

    @include('hostelStaff.partials.studentAndFeeInformationModal')

@endsection