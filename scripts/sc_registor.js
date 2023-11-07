function validateForm() 
{
    var name = document.getElementById('acc_name');
    var email = document.getElementById('acc_email');
    var password = document.getElementById('acc_password');
    var cpassword = document.getElementById('acc_cpassword');

    var errorName = document.getElementById('error_name');
    var errorEmail = document.getElementById('error_email');
    var errorPassword = document.getElementById('error_password');
    var errorCPassword = document.getElementById('error_cpassword');

    // Regular expression for validating email
    var emailRegex = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;

    // Regular expression for checking if name contains numbers
    var nameRegex = /\d/;

    if (name.value === '') {
        errorName.textContent = 'Name is required.';
        return false;
    } else if (nameRegex.test(name.value)) {
        errorName.textContent = 'Name should not contain numbers.';
        return false;
    } else {
        errorName.textContent = '';
    }

    if (email.value === '') {
        errorEmail.textContent = 'Email is required.';
        return false;
    } else if (!emailRegex.test(email.value)) {
        errorEmail.textContent = 'Please enter a valid email.';
        return false;
    } else {
        errorEmail.textContent = '';
    }

    if (password.value === '') {
        errorPassword.textContent = 'Password is required.';
        return false;
    } else {
        errorPassword.textContent = '';
    }

    if (cpassword.value === '') {
        errorCPassword.textContent = 'Confirm Password is required.';
        return false;
    } else if (cpassword.value !== password.value) {
        errorCPassword.textContent = 'Passwords do not match.';
        return false;
    } else {
        errorCPassword.textContent = '';
    }

   return true;
}


function clearErrorMessages() 
{
    var errorName = document.getElementById('error_name');
    var errorEmail = document.getElementById('error_email');
    var errorPassword = document.getElementById('error_password');
    var errorCPassword = document.getElementById('error_cpassword');

    // Clear the error messages
    errorName.textContent = '';
    errorEmail.textContent = '';
    errorPassword.textContent = '';
    errorCPassword.textContent = '';
}
