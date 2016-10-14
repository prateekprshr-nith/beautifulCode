@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-info-sign"></span>
                        <strong>Things to manage.</strong>
                    </div>

                    <h4> <strong>Manage Users:</strong> </h4>

                    <blockquote class="text-justify">

                        <h4><strong>1). Teachers: </strong></h4>

                        <blockquote class="text-justify">
                            <p> <strong>a). </strong>Click on <strong>Teachers</strong> tab,
                                here you will see all the teachers registered.</p>

                            <p><strong>b).</strong>You can delete a teacher's account by clicking on
                                <strong>Remove</strong> button in the corresponding row.</p>

                            <p><strong>c).</strong>You can add a teacher's account by filling appropriate details
                                in the form below the <strong>registered teachers</strong> table.</p>

                        </blockquote>

                        <h4><strong>2). Hostel Staff: </strong></h4>

                        <blockquote class="text-justify">
                            <p> <strong>a). </strong>Click on <strong>Hostel Staff</strong> tab,
                                here you will see all the hostel staff members registered.</p>

                            <p><strong>b).</strong>You can delete a hostel staff members's account by clicking on
                                <strong>Remove</strong> button in the corresponding row.</p>

                            <p><strong>c).</strong>You can add a hostel staff members's account by filling appropriate details
                                in the form below the <strong>registered hostel staff members</strong> table.</p>

                        </blockquote>

                        <h4><strong>3). Department Staff: </strong></h4>

                        <blockquote class="text-justify">
                            <p> <strong>a). </strong>Click on <strong> Department Staff</strong> tab,
                                here you will see all the  department staff members registered.</p>

                            <p><strong>b).</strong>You can delete a department staff members's account by clicking on
                                <strong>Remove</strong> button in the corresponding row.</p>

                            <p><strong>c).</strong>You can add a department staff members's account by filling appropriate details
                                in the form below the <strong>registered department Staff members</strong> table.</p>

                        </blockquote>

                        <h4><strong>4). Account Staff: </strong></h4>

                        <blockquote class="text-justify">
                            <p> <strong>a). </strong>Click on <strong>Account Staff</strong> tab,
                                here you will see all the account staff members registered.</p>

                            <p><strong>b).</strong>You can delete a account staff members's account by clicking on
                                <strong>Remove</strong> button in the corresponding row.</p>

                            <p><strong>c).</strong>You can add a account staff members's account by filling appropriate details
                                in the form below the <strong>registered account staff members</strong> table.</p>

                        </blockquote>

                        <h4><strong>5). Library Staff: </strong></h4>

                        <blockquote class="text-justify">
                            <p> <strong>a). </strong>Click on <strong>Library Staff</strong> tab,
                                here you will see all the library staff members registered.</p>

                            <p><strong>b).</strong>You can delete a library staff members's account by clicking on
                                <strong>Remove</strong> button in the corresponding row.</p>

                            <p><strong>c).</strong>You can add a library staff members's account by filling appropriate details
                                in the form below the <strong>registered library staff members</strong> table.</p>

                        </blockquote>

                        <h4><strong>6). Chief Warden Staff: </strong></h4>

                        <blockquote class="text-justify">
                            <p> <strong>a). </strong>Click on <strong>Chief Warden Staff</strong> tab,
                                here you will see all the chief warden staff members registered.</p>

                            <p><strong>b).</strong>You can delete a chief warden staff members's account by clicking on
                                <strong>Remove</strong> button in the corresponding row.</p>

                            <p><strong>c).</strong>You can add a chief warden staff members's account by filling appropriate details
                                in the form below the <strong>registered chief warden staff members</strong> table.</p>

                        </blockquote>

                        <h4><strong>7). Students: </strong></h4>

                        <blockquote class="text-justify">
                            <p> <strong>a). </strong>Click on <strong>Students</strong> tab,
                                here you will see all the students registered.</p>

                            <p><strong>b).</strong>You can delete a students's account by clicking on
                                <strong>Remove</strong> button in the corresponding row.</p>

                            <p><strong>c).</strong>If the student faces some problem with email verification
                                you can verify his/her's account by clicking on <strong>Verify</strong> button.</p>

                        </blockquote>

                    </blockquote>

                    <h4> <strong>Manage Departments, Sections and Hostels:</strong> </h4>

                    <blockquote class="text-justify">

                        <h4><strong>1). Department: </strong></h4>

                        <blockquote class="text-justify">
                            <p> <strong>a). </strong>Click on <strong>Department</strong> tab,
                                here you will see all the departments present in the database.</p>

                            <p><strong>b).</strong>You can delete a department by clicking on
                                <strong>Remove</strong> button in the corresponding row.</p>

                            <p><strong>c).</strong>You can add a departments by filling appropriate details
                                in the form below the <strong>departments</strong> table.</p>

                        </blockquote>

                        <h4><strong>2). Sections: </strong></h4>

                        <blockquote class="text-justify">
                        <p> <strong>a). </strong>Click on <strong>Sections</strong> tab,
                            here you will see all the sections present in the database.</p>

                        <p><strong>b).</strong>You can delete a section by clicking on
                            <strong>Remove</strong> button in the corresponding row.</p>

                        <p><strong>c).</strong>You can add a section by filling appropriate details
                            in the form below the <strong>sections</strong> table. Enter secton id and select the department
                            to which that section belongs.</p>

                        </blockquote>

                        <h4><strong>3). Hostels: </strong></h4>

                         <blockquote class="text-justify">
                            <p> <strong>a). </strong>Click on <strong>Hostels</strong> tab,
                                here you will see all the hostels present in the database.</p>

                             <p><strong>b).</strong>You can delete a hostel by clicking on
                                 <strong>Remove</strong> button in the corresponding row.</p>

                             <p><strong>c).</strong>You can add a hostel by filling appropriate details
                                 in the form below the <strong>hostels</strong> table.</p>

                         </blockquote>

                    </blockquote>

                    <h4> <strong>Manage Registration process:</strong> </h4>

                    <blockquote class="text-justify">
                        <h4><strong>Steps:</strong></h4>

                        <p> <strong>a). </strong>See the status of each user. If its <strong>Deactivated</strong>
                            click on <strong>Activate</strong> to activate the process for the users.</p>

                        <p> <strong>b). </strong>Once all the students are registered click <strong>Deactivate</strong>
                            to deactivate the registration process.</p>

                    </blockquote>
                </div>
            </div>
        </div>
    </div>
@endsection