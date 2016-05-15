<!DOCTYPE html>
<html lang="en">
<head>
    <link href="{{env('APP_DIR')}}/public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container-fluid">
    <div class="col-xs-12 text-center">
        <h2><strong>NATIONAL INSTITUTE OF TECHNOLOGY, HAMIRPUR</strong></h2>
    </div>

    <div class="col-xs-5 col-xs-offset-6 text-right">
        <h4>
            <strong>Registration Number:</strong> <u>{{Auth::guard('student')->user()->registrationNo}}</u>
            <strong>Verification Code:</strong> {{Auth::guard('student')->user()->currentStudentState->verificationCode}}
        </h4>
    </div>

    <div class="col-xs-6 col-xs-offset-3 text-center">
        <h3 class="col-xs-12"><strong>REGISTRATION CARD</strong></h3>
        <h3>
            <strong>
                (Session:
                @if(date('m') < 6)
                    <u>{{date('Y') - 1}} - {{date('Y')}})</u>
                @else
                    <u>{{date('Y')}} - {{date('Y') + 1}})</u>
                @endif
            </strong>
        </h3>
        <h3>(Part-1)</h3>
        <h3><strong>Roll Number:</strong> <u>{{Auth::guard('student')->user()->rollNo}}</u></h3>
    </div>

    <img src="{{env('APP_DIR')}}/public/images/photo.png" class="col-xs-3" height="200" alt="Photo">

    <div class="col-xs-12 text-left">
        <h4 class="col-xs-12"><strong>Name:</strong> <u>{{Auth::guard('student')->user()->name}}</u></h4>
        <h4 class="col-xs-6"><strong>Father's Name:</strong> <u>{{Auth::guard('student')->user()->fatherName}}</u></h4>
        <h4 class="col-xs-6">
            <strong>Class:</strong>
            @if(Auth::guard('student')->user()->dCode === 'ARD')
                <u>B. Arch</u>
            @else
                <u>B. Tech</u>
            @endif
        </h4>
        <h4 class="col-xs-9"><strong>Department:</strong> <u>{{Auth::guard('student')->user()->department->dName}}</u></h4>
        <h4 class="col-xs-3 text-left"><strong>Semester:</strong> <u>{{Auth::guard('student')->user()->semNo}}</u></h4>
        <h4 class="col-xs-6">
            <strong>Hostler/Day Scholar:</strong>
            @if(Auth::guard('student')->user()->currentStudentState->hostler == true)
                <u>Hostler</u>
            @else
                <u>Day Scholar</u>
            @endif
        </h4>
    </div>

    <div class="col-xs-12">
        <div class="col-xs-6">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <strong>Address for Correspondence</strong>
                </div>
                <div class="panel-body" style="height: 3cm">
                    <h4 class="text-justify"><u>{{Auth::guard('student')->user()->currentAddress}}</u></h4>
                </div>
                <div class="panel-footer">
                    <h6 class="col-xs-6">Phone No.: <u>{{Auth::guard('student')->user()->phoneNo}}</u></h6>
                    <h6>E-mail Id: <u>{{Auth::guard('student')->user()->email}}</u></h6>
                </div>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <strong>Permanent Address</strong>
                </div>
                <div class="panel-body" style="height: 3cm">
                    <h4 class="text-justify"><u>{{Auth::guard('student')->user()->permanentAddress}}</u></h4>
                </div>
                <div class="panel-footer">
                    <h6 class="col-xs-6">Phone No.: <u>{{Auth::guard('student')->user()->phoneNo}}</u></h6>
                    <h6>E-mail Id: <u>{{Auth::guard('student')->user()->email}}</u></h6>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-12 text-center">
        <h3><strong>Results of Previous Semester(s)</strong></h3>
    </div>

    <div class="col-xs-12">
        <table border="1" class="col-xs-10 col-xs-offset-1">
            <thead>
                <tr>
                    <th class="text-center"><strong>Semester</strong></th>
                    <th class="text-center"><strong>CGPI</strong></th>
                    <th class="text-center"><strong>SGPI</strong></th>
                    <th class="text-center"><strong>Repeat (if any)</strong></th>
                </tr>
            </thead>
            <tbody>
                @foreach(Auth::guard('student')->user()->grade as $grade)
                    <tr>
                        <td class="text-center"><strong>{{$grade->semNo}}</strong></td>
                        <td class="text-center">{{$grade->sgpi}}</td>
                        <td class="text-center">{{$grade->cgpi}}</td>
                        <td class="text-center">{{$grade->supplementaries}}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <div class="col-xs-12" style="padding-top: 1cm">
        <div class="col-xs-5 col-xs-offset-6 text-right">
            <h4>
                <strong>Signature of the student</strong>
            </h4>
        </div>
    </div>

    <div class="col-xs-6 col-xs-offset-3 text-center">
        <h3>(Part-2)</h3>
    </div>

    <div class="col-xs-12 text-center">
        <h3><strong>Courses</strong></h3>
    </div>

    <div class="col-xs-12">
        <table border="1" class="col-xs-10 col-xs-offset-1">
            <thead>
                <tr>
                    <th class="text-center"><strong>Sr. No.</strong></th>
                    <th class="text-center"><strong>Course Code</strong></th>
                    <th class="text-center"><strong>Title</strong></th>
                    <th class="text-center"><strong>L</strong></th>
                    <th class="text-center"><strong>T</strong></th>
                    <th class="text-center"><strong>P</strong></th>
                    <th class="text-center"><strong>C</strong></th>
                </tr>
            </thead>
            <tbody>
                {{-- */$l=0; $t=0; $p=0; $c=0;/* --}}
                @foreach ($courses as $course)
                    <tr>
                        <td class="text-center"><strong>{{ ++$count }}</strong></td>
                        <td class="text-center">{{ $course->courseCode }}</td>
                        <td class="text-center">{{ $course->courseName }}</td>
                        <td class="text-center">{{ $course->lectures }} {{-- */ $l += $course->lectures; /* --}}</td>
                        <td class="text-center">{{ $course->tutorials }} {{-- */ $t += $course->tutorials; /* --}}</td>
                        <td class="text-center">{{ $course->practicals }} {{-- */ $p += $course->practicals; /* --}}</td>
                        <td class="text-center">{{ $course->credits }} {{-- */ $c += $course->credits; /* --}}</td>
                    </tr>
                @endforeach
                @foreach ($allocatedElectives as $course)
                    <tr>
                        <td class="text-center"><strong>{{ ++$count }}</strong>{{ ++$count }}</td>
                        <td class="text-center">{{ $course->courseCode }}</td>
                        <td class="text-center">{{ $course->courseName }}</td>
                        <td class="text-center">{{ $course->lectures }} {{-- */ $l += $course->lectures; /* --}}</td>
                        <td class="text-center">{{ $course->tutorials }} {{-- */ $t += $course->tutorials; /* --}}</td>
                        <td class="text-center">{{ $course->practicals }} {{-- */ $p += $course->practicals; /* --}}</td>
                        <td class="text-center">{{ $course->credits }} {{-- */ $c += $course->credits; /* --}}</td>
                    </tr>
                @endforeach
                <tr>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-right" style="padding-right: 1%"><strong>Total</strong></td>
                    <td class="text-center">{{ $l }}</td>
                    <td class="text-center">{{ $t }}</td>
                    <td class="text-center">{{ $p }}</td>
                    <td class="text-center">{{ $c }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="col-xs-12" style="padding-top: 1cm">
        <div class="col-xs-5 col-xs-offset-6 text-right">
            <h4>
                <strong>Departmental Course Convener</strong>
            </h4>
            <h4>
                <strong>NIT Hamirpur (H.P.)</strong>
            </h4>
        </div>
    </div>
</div>
</body>
</html>