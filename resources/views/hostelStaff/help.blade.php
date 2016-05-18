@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-info-sign"></span>
                        <strong> Steps to be followed.</strong>
                    </div>

                    <h4> <strong>Steps:</strong> </h4>

                    <blockquote class="text-justify">

                        <p> <strong>a). </strong>Click on <strong>Registration requests</strong> on top of your screen,
                            here you will see the student's requests.</p>

                        <p> <strong>b). </strong>Any new request will appear in <strong>New request</strong> tab.
                            You can view student's details and if the student doesn't have any fine pending you can approve the request
                            by clicking on <strong>Approve</strong>. If there is any fine pending, you can keep the request
                            on hold by clicking <strong>hold</strong> and add a remark describing the problem.</p>

                        <p> <strong>c). </strong>If request was accepted it will be available under <strong>Approved Request</strong>
                            tab. If it was kept on hold, it will be available under <strong>Pending request</strong> tab.</p>

                        <p> <strong>d). </strong>If a request was on hold and student resolved the problem, then click
                            on <strong>pending requests</strong> and approve his/her's request by clicking on <strong>approve</strong>.</p>

                        <p> <strong>e). </strong>Once the student's request is approved, it can be viewed in
                            <strong>approved requests</strong> tab.</p>


                    </blockquote>
                </div>
            </div>
        </div>
    </div>
@endsection