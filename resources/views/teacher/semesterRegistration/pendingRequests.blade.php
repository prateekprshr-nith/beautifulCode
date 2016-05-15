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
                                <li role="presentation" class="active">
                                    <a href="/teachers/semesterRegistration/studentRequests/pending">
                                        Pending Requests <span class="badge">{{$requestCount['pendingCount']}}</span>
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="/teachers/semesterRegistration/studentRequests/approved">
                                        Approved Requests <span class="badge">{{$requestCount['approvedCount']}}</span>
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="/teachers/semesterRegistration/studentRequests/all">
                                        All Requests <span class="badge">{{$requestCount['totalCount']}}</span>
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
                                                   data-target="#myModal" onclick='setImageSrc("feeReceiptImage",
                                                        "/teachers/semesterRegistration/studentRequests/feeReceipts/",
                                                        "{{$request->rollNo}}")' data-rollno="{{$request->rollNo}}">
                                                    <span class="glyphicon glyphicon-info-sign"></span> View fee receipt and info
                                                </a>
                                            </td>
                                            <td>{{$request->remarks}}</td>
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