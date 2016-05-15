/*
 * This file contains custom functions used for
 * adding some interactivity to the web pages
 */

/*
 * This function checks if password
 * is same in password and confirm
 * password fields of the web page
 */
function checkPassword(formId, buttonId)
{

    var password = document.forms[formId]["password"].value;
    var cPassword = document.forms[formId]["confirmPassword"].value;

    if(password != cPassword) {
        document.getElementById('passwordErrorMsg').setAttribute('class', 'alert alert-danger text-center');
        document.getElementById('passwordErrorMsg').innerHTML = 'Passwords do not match!!';
        document.getElementById(buttonId).setAttribute('disabled', '');
    }
    else
    {
        document.getElementById('passwordErrorMsg').removeAttribute('class');
        document.getElementById('passwordErrorMsg').innerHTML = '';
        document.getElementById(buttonId).removeAttribute('disabled');
    }
}

/*
 * This function toggles an element
 */
function toggleDisable(elementId)
{
    if(document.getElementById(elementId).hasAttribute('disabled'))
    {
        document.getElementById(elementId).removeAttribute('disabled')
    }
    else
    {
        document.getElementById(elementId).setAttribute('disabled', '');
    }
}

/*
 * This function loads an avatar icon in
 * case user has no profilepicture.
 */
function loadAvatarIcon(elementId)
{
    document.getElementById(elementId).src = '/images/circle.png';
}

/*
 * This function validates the size of file being uploaded
 */
function validateFileSize(formId, elementId)
{
    var x = document.getElementById(elementId);

    // Check for the file size
    if(x.files[0].size > 2097152)
    {
        alert('Please choose a file with size less than 2MB!!');
        document.getElementById(formId).reset();
    }
}

/*
 * This function sets the src field of an image
 */
function setImageSrc(elementId, documentUrl, subUrl)
{
    document.getElementById(elementId).src = documentUrl + subUrl;
}

/*
 * This function sets the data-* attribute of elective status buttons
 */
function setBtnData(element, electiveType, no)
{
    var statusBtn;

    if(electiveType === 'open')
    {
        statusBtn = $('#ostatusBtn'+no);
    }
    else
    {
        statusBtn = $('#dstatusBtn'+no);
    }

    if(element.value != '')
    {
        statusBtn.prop('disabled', false);
        statusBtn.attr('data-course', element.value);
    }
    else
    {
        statusBtn.prop('disabled', true);
    }

}

/*
 * This function sends an ajax request and displays the status of elective
 */
function getElectiveInfo(button)
{
    var courseCode = button.getAttribute('data-course');
    var modal = $('#myModal');

    modal.on('hidden.bs.modal', function ()
    {
        $('.modal-body').html('<h4>The elective <span id="electiveName"></span> <span id="electiveStatus"></span></h4>');
    });

    if(courseCode === '')
    {
        modal.modal('show');
        $('.modal-body').html('<h4>Please choose an elective to check the status</h4>');
    }
    else
    {
        var url = '/students/semesterRegistration/courseDetails/electiveInfo/' + courseCode;

        $.get(url, function(availableSeats)
        {
            modal.modal('show');
            $('#electiveName').text(courseCode);

            if(availableSeats == 0)
            {
                $('#electiveStatus').text(' is not having any vacant seats. Please choose another one.');
                
            }
            else
            {
                $('#electiveStatus').text(' is having ' + availableSeats + ' vacant seats.');
            }
        });
    }
}