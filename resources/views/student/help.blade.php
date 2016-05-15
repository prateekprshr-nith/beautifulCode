@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-info-sign"></span>
                        <strong> Steps to be followed.</strong>
                    </div>

                    <div class = "panel-body" >
                        <h4> <strong>Step 1:</strong> </h4>
                        <blockquote class="text-justify">
                            <p> <strong>a). </strong>Click on <strong>Semester Registration</strong> on top right of the screen.
                                This link will be active for a limited amount of time.</p>

                            <p> <strong>b). </strong>Your details will appear on screen. Check your details & correct them if need be
                                by clicking on <strong>Update details</strong>.</p>

                            <p> <strong>c). </strong>Check the semester in which you are registering.</p>

                            <p> <strong>d). </strong>Enter your <strong>CGPI</strong>, <strong>SGPI</strong> and the
                                <strong>supplementary</strong>(if any) which are not yet cleared, in appropriate box.</p>

                            <p> <strong>e). </strong>If you have a fee slip in which your <strong>Name</strong> &
                                <strong>Roll No.</strong> are clearly visible then click on <strong>YES</strong>. If above
                                stated conditions are not met or you pay fee via <strong>education loan</strong>,
                                click on <strong>NO</strong>.</p>

                            <p> <strong>f). </strong>If you pay your fee via <strong>education loan</strong> then click on
                                <strong>YES</strong> else click on <strong>NO</strong>.</p>

                            <p> <strong>g). </strong>If you were a  <strong>Hosteler</strong> previous semester then
                                click on <strong>YES</strong> else click on <strong>NO</strong>.</p>
                        </blockquote>
                    </div>

                    <div class = "panel-body">
                        <h4> <strong>Step 2:</strong> </h4>

                        <blockquote class="text-justify">

                            <p> <strong>a). </strong>Upload <strong>authentic</strong> and <strong>clear</strong> image
                                of your fee slip.</p>

                            <p> <strong>b). </strong>Select the <strong>hostel</strong> in which you were residing during
                                your<strong> previous semester</strong>, from the drop down list nad click on
                                <strong>Next step.</strong>.</p>

                            <p><strong>note:</strong>If you are a <strong>day scholar</strong> then just perform <strong>step b)</strong>
                                or if you <strong>don't have fee slip</strong> then just perform <strong>step a)</strong>. </p>

                            <p>If you are day <strong>scholar</strong> and <strong>do not have fee slip</strong>
                                the just click on <strong>Next step</strong>. </p>

                        </blockquote>
                    </div>

                    <div class = "panel-body">
                        <h4> <strong>Step 3:</strong> </h4>

                        <blockquote class="text-justify">
                            <p> <strong>a). </strong>Here your courses are shown, select any <strong>Department Elective</strong>
                            or <strong>Open Elective</strong> as applicable from drop down list.</p>
                            <p><strong>Note:</strong>You can also check number of students registered in an elective by clicking on
                            <strong>Check Vacant Seats</strong></p>

                        </blockquote>
                    </div>

                    <div class = "panel-body">
                        <h4> <strong>Step 4:</strong> </h4>

                        <blockquote class="text-justify">
                            <p> <strong>a). </strong>Wait till your request is <strong>approved</strong> from all.
                            <p> <strong>b). </strong>Once your request is <strong>approved</strong>, you can <strong>download
                                    </strong>your form by clicking on <strong>Download Form</strong> button.
                        </blockquote>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-info-sign"></span>
                        <strong> Flowchart of the process.</strong>
                        <img src="/images/StudentRegFlow.png" class="img-responsive img-thumbnail center-block" alt="Cinque Terre">
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
