@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Enter the verification code sent on your email</strong>
                    </div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form class="form-horizontal" role="form" method="POST" action="/students/verify" accept-charset="UTF-8" id="verificationForm">
                            <input required name="_token" type="hidden">
                            {{ csrf_field() }}

                            <!-- Display Validation Errors -->
                            @include('common.errors')

                            <!-- Code -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="verificationCode">Verification Code</label>
                                <div class="col-md-6">
                                    <input required class="form-control" name="verificationCode" type="text" id="verificationCode">
                                </div>
                            </div>

                            <!-- Fourth row Login-->
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button class="btn btn-primary" type="submit" id="loginButton">
                                        <span class="glyphicon glyphicon-check"></span> Verify
                                    </button>

                                    <a class="btn btn-link" href="/students/verify/sendVerificationMail">Send verification Mail</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection