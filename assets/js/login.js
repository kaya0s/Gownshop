document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('passwordInput');
    const showPassword = document.getElementById('showPassword');
    const hidePassword = document.getElementById('hidePassword');

    // Initially hide the "hide password" icon
    hidePassword.style.display = 'none';

    // Toggle password visibility when clicking show/hide icons
    showPassword.addEventListener('click', function() {
        passwordInput.type = 'text';
        showPassword.style.display = 'none';
        hidePassword.style.display = 'block';
    });

    hidePassword.addEventListener('click', function() {
        passwordInput.type = 'password';
        hidePassword.style.display = 'none';
        showPassword.style.display = 'block';
    });
});