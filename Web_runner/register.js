function validateForm() {
    var email = document.getElementById('user_email').value;
    var user_name = document.getElementById('user_name').value;
    var password = document.getElementById('user_password').value;
    var confirmPassword = document.getElementById('user_confirm_password').value;

    // Perform basic validation
    if (email.trim() === '' || user_name.trim() === '' || password.trim() === '' || confirmPassword.trim() === '') {
        alert('Please enter all fields.');
        return false;
    }

    // Check if passwords match
    if (password !== confirmPassword) {
        alert('Passwords do not match. Please enter the same password in both fields.');
        return false;
    }

    //check if password is not complex
    if(!isPasswordComplex(password)) {
        alert('Password must be at least 8 characters and include at least one lowercase letter, one uppercase letter, and one digit.');
        return false;        
    }
    return true; // Allow form submission
}
function isPasswordComplex(password) {
    var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
    return regex.test(password);
}
