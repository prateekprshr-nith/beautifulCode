@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-info-sign"></span>
                        <strong> Steps to be followed for semester registration.</strong>
                    </div>

                    <div class = "panel-body" >
                        <h4> <strong>Step 1:</strong> </h4>
                        <blockquote class="text-justify">
                            <p> <strong>a). </strong>Click on <strong>Register as an incharge</strong> on top of your screen,
                                enter the semester of which you are incharge and click on <strong>Update</strong> button.</p>

                            <p> <strong>b). </strong>Now go to the <strong>Choose courses/electives</strong> tab and enter
                                number of <strong>Open Electives</strong>/<strong>Department Electives</strong> offered in that semester.
                                Then click on <strong>Update</strong> button.</p>

                            <p><strong>Note:</strong> If no <strong>electives</strong> are offered in that semester, just
                            enter <strong>0</strong> in the text field.</p>

                        </blockquote>
                    </div>

                    <div class = "panel-body">
                        <h4> <strong>Step 2:</strong> </h4>

                        <blockquote class="text-justify">

                            <p> <strong>a). </strong>Click on <strong>Registration requests</strong> on top of your screen,
                                here you will see the student's requests.</p>

                            <p> <strong>b). </strong>Any new request will appear in <strong>New request</strong> tab.
                            You can view student's fee slip and if its authentic and clear you can approve the request
                            by clicking on <strong>Approve</strong>. If there is any disparity in fee slip you can keep the request
                            on hold by clicking <strong>hold</strong> and add a remark describing the problem.</p>

                            <p> <strong>c). </strong>If request was accepted it will be available under <strong>Approved Request</strong>
                            tab. If it was kept on hold, it will be available under <strong>Pending request</strong> tab.</p>

                            <p> <strong>d). </strong>If a request was on hold and student uploaded fee slip again, then request will
                             appear in <strong>New requests</strong> tab. In this situation <strong>step b</strong> will be repeated.</p>

                            <p> <strong>e). </strong>Once the student's request is approved by all, you can register the student
                                by clicking on <strong>Register</strong> button in <strong>all requests</strong> tab.</p>

                            <p> <strong>f). </strong>A unique code will be generated next to <strong>register</strong> button.
                                This code will be different for all students and you can verify student by matching this code
                                with the code that will be printed on students final registration form.</p>

                            <p> <strong>Note: </strong>If student entered a wrong information and requests to restart
                            his/her registration process, you can delete his/her's request by clicking on <strong>Delete</strong>
                            button in <strong>all requests</strong> tab.</p>

                        </blockquote>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-info-sign"></span>
                        <strong> Steps to download students list of an elective.</strong>
                    </div>
                    <div class="panel-body">
                        <h4> <strong>Steps:</strong> </h4>

                        <blockquote class="text-justify">
                            <p> <strong>a). </strong>Click on <strong>Elective students list</strong> on top of your screen,
                                here you can download the list of students of a particular elective.</p>

                            <p> <strong>b). </strong>Select a course from the drop down list and click on download
                                button. A pdf will be downloaded which contains names of students in that elective.</p>

                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
