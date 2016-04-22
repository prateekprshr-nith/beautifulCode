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
                                <a href="/teachers/semesterRegistration/studentRequests/new">New Requests</a>
                            </li>
                            <li role="presentation">
                                <a href="/teachers/semesterRegistration/studentRequests/pending">Pending Requests</a>
                            </li>
                            <li role="presentation">
                                <a href="/teachers/semesterRegistration/studentRequests/all">All Requests</a>
                            </li>
                        </ul>
                    </div>

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
                                        <td>{{ ++$count }}</td>
                                        <td>{{ $request->rollNo }}</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-primary">
                                                <span class="glyphicon glyphicon-info-sign"></span> View fee receipt and info
                                            </a>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-danger">
                                                <span class="glyphicon glyphicon-ok"></span> Approve
                                            </a>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-primary">
                                                <span class="glyphicon glyphicon-pause"></span> Keep on hold
                                            </a>
                                        </td>
                                        <td>
                                            <textarea class="form-control verticalAlign" rows="1"></textarea>
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