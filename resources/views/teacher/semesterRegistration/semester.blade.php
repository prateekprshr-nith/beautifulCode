@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-edit"></span> Please enter the required details
                    </div>

                    <div class="panel-body">
                        <ul class="nav nav-tabs nav-justified">
                            <li role="presentation" class="active">
                                <a href="/teachers/semesterRegistration/semester">
                                    Choose semester
                                    @if(Auth::guard('teacher')->user()->semNo != null)
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @endif
                                </a>
                            </li>
                            @if(Auth::guard('teacher')->user()->semNo == null)
                                <li class="disabled" >
                                    <a href="/teachers/semesterRegistration/courses">Choose courses</a>
                                </li>
                            @else
                                <li>
                                    <a href="/teachers/semesterRegistration/courses">
                                        Choose courses/electives
                                        @if(count($electiveCount) > 0)
                                            <span class="glyphicon glyphicon-ok"></span>
                                        @endif
                                    </a>
                                </li>
                            @endif
                        </ul>

                        <br>

                        <div class="row">
                            <div class="well well-sm text-center text-primary col-md-6 col-md-offset-3">
                                @if(Auth::guard('teacher')->user()->semNo == null)
                                    You have not chosen any semester. Please choose a semester.
                                @else
                                    You are incharge of semester: {{Auth::guard('teacher')->user()->semNo}}
                                @endif
                            </div>

                        </div>

                        <form class="form-horizontal" role="form" method="POST" action="/teachers/semesterRegistration/semester"
                              accept-charset="UTF-8" id="semesterForm">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                            @include('common.errors')

                            <div class="col-md-2">
                                <label for="semester" class="control-label">Semseter</label>
                            </div>

                            <div class="col-md-8">
                                <input required class="form-control" name="semNo" type="number" min="1" max="10"
                                       id="semester" placeholder="{{Auth::guard('teacher')->user()->semNo}}">
                            </div>

                            <div class="col-md-2">
                                <button class="btn btn-sm btn-primary" type="submit">
                                    <span class="glyphicon glyphicon-plus"></span> Update
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection