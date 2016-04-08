/*
 * This file contains some custom functions used for
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
 * This function toggles the visibility of an element
 */
function toggleVisibility(elementId)
{
    if(document.getElementById(elementId).hasAttribute('hidden'))
    {
        document.getElementById(elementId).removeAttribute('hidden')
    }
    else
    {
        document.getElementById(elementId).setAttribute('hidden', '');
    }
}

/*
 * This function loads an avatar icon in
 * case user has no profilepicture.
 */
function loadAvatarIcon()
{
    document.getElementById('avatarImage').src = '/images/circle.png';
}