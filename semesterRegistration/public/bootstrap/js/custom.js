/*
 * This file contains some custom fucntions
 */

// Function to check if passords are same
function checkPassword()
{
    var password = document.forms["registerForm"]["password"].value;
    var cPassword = document.forms["registerForm"]["confirmPassword"].value;

    if(password != cPassword) {
        document.getElementById('passwordErrorMsg').innerHTML = 'Passwords do not match!!';
        document.getElementById('registerButton').setAttribute('disabled', '');
    }
    else
    {
        document.getElementById('passwordErrorMsg').innerHTML = '';
        document.getElementById('registerButton').removeAttribute('disabled');
    }
}