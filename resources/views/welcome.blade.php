@extends('layouts.app')

@section('content')
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
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="text-center text-info">Welcome to NIT Hamirpur Online Semester Registration</h1>
                </div>
                <div class="panel-body">
                    <!-- #TODO make this view beatiful -->
                    <img src="/images/NIT-Hamirpur1.jpg" class="img-responsive img-thumbnail center-block" alt="Cinque Terre">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
