<!-- Student fee receipt and information Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">
                    <span class="glyphicon glyphicon-user"></span>
                    <strong> Information for <span id="id"></span></strong>
                </h4>
            </div>
            <div class="modal-body">

                <h4 class="text-center"><span class="glyphicon glyphicon-info-sign"></span> Student details</h4>

                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td><strong>Name</strong></td>
                            <td id="name"></td>
                        </tr>
                        <tr>
                            <td><strong>Father's name</strong></td>
                            <td id="fatherName"></td>
                        </tr>
                        <tr>
                            <td><strong>Mother's name</strong></td>
                            <td id="motherName"></td>
                        </tr>
                        <tr>
                            <td><strong>Roll No.</strong></td>
                            <td id="rollNo"></td>
                        </tr>
                        <tr>
                            <td><strong>Section</strong></td>
                            <td id="sectionId"></td>
                        </tr>
                        <tr>
                            <td><strong>Department</strong></td>
                            <td id="department"></td>
                        </tr>
                        <tr>
                            <td><strong>Registering for semester</strong></td>
                            <td id="semNo"></td>
                        </tr>
                        <tr>
                            <td><strong>Date of Birth</strong></td>
                            <td id="dob"></td>
                        </tr>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td id="email"></td>
                        </tr>
                        <tr>
                            <td><strong>Phone no</strong></td>
                            <td id="phoneNo"></td>
                        </tr>
                        <tr>
                            <td><strong>Current Address</strong></td>
                            <td id="currentAddress"></td>
                        </tr>
                        <tr>
                            <td><strong>Permanent Address</strong></td>
                            <td id="permanentAddress"></td>
                        </tr>
                    </tbody>
                </table>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Send the ajax request and get the student information
    $('#myModal').on('show.bs.modal', function (event)
    {
        var button = $(event.relatedTarget);
        var recipient = button.data('rollno');
        var url = "/adminStaffs/semesterRegistration/studentRequests/studentInfo/" + recipient;

        var modal = $(this);

        modal.find('#id').text(recipient);

        $.get(url, function(student)
        {
            modal.find('#name').text(student.name);
            modal.find('#fatherName').text(student.fatherName);
            modal.find('#motherName').text(student.motherName);
            modal.find('#rollNo').text(student.rollNo);
            modal.find('#sectionId').text(student.sectionId);
            modal.find('#dob').text(student.dob);
            modal.find('#email').text(student.email);
            modal.find('#phoneNo').text(student.phoneNo);
            modal.find('#currentAddress').text(student.currentAddress);
            modal.find('#permanentAddress').text(student.permanentAddress);
            modal.find('#department').text(student.department.dName);
            modal.find('#semNo').text(student.current_student_state.semNo);
        });
    })
</script>