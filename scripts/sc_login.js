function validateForm() 
{
    var email = document.getElementById('acc_email');
    var password = document.getElementById('acc_password');

    var errorEmail = document.getElementById('error_email');
    var errorPassword = document.getElementById('error_password');

    // Regular expression for validating email
    var emailRegex = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;

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

   return true;
}
