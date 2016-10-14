@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Select a course-->
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-pushpin"></span>
                    <strong> Select a course to download the list of students</strong>
                </div>

                <div class="panel-body">
                    <div class="input-group">
                        @if($electives->isEmpty())
                            No courses are present in the database.
                        @else
                            <select required id="courseCode" name="courseCode" class="form-control">
                                <option value="">Select a Course...</option>
                                @foreach($electives as $elective)
                                    <option value="{{$elective->courseCode}}">{{$elective->courseCode}}: {{$elective->courseName}}</option>
                                @endforeach
                            </select>

                            <span class="input-group-btn">
                                <a href="" id="electiveListDownloadLink" class="btn btn-primary"
                                   onclick='setLinkUrl("electiveListDownloadLink", document.URL + "/", document.getElementById("courseCode").value)'>
                                    <span class="glyphicon glyphicon-download"></span> Download
                                </a>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
