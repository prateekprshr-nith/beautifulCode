@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-user"></span>
                        <strong> Please choose your profile picture</strong>
                    </div>
                    <div class="panel-body">
                        @include('student.partials.imageUplodForm')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection