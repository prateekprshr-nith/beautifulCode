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

                        <p> <strong>a). </strong>Click on <strong>Courses</strong> on top of your screen,
                            here you will see all the courses of your department.</p>

                        <p> <strong>b). </strong>To add a new course click <strong>add a new course</strong>.</p>

                        <p> <strong>c). </strong>Type all the details of the course accordingly.</p>

                        <p> <strong>d). </strong>If you want to delete a course from the database click
                            on <strong>remove</strong> button of that course row.</p>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
@endsection