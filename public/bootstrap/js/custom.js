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