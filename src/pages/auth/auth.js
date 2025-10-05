document.addEventListener('DOMContentLoaded', function() {
    if (document.body.id == 'signup' || document.body.id == 'reset-pw') {
        const passwordInput = document.querySelector('input[name="password"]');
        passwordInput.addEventListener('input', function() {
            const password = passwordInput.value;
            const isValid = password.length >= 8 &&
                            /[a-z]/.test(password) &&
                            /[A-Z]/.test(password) &&
                            /[0-9]/.test(password) &&
                            /[!@#$%^&*()_+\-=\[\]{};':\"\\|,.<>?]/.test(password);
            if (!isValid) {
                passwordInput.classList.add('input-error');
            } else {
                passwordInput.classList.remove('input-error');
            }
        });

        const emailInput = document.querySelector('input[name="email"]');
        emailInput.addEventListener('input', function() {
            const email = emailInput.value.trim();
            const validEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (email == '' || validEmail.test(email)) {
                emailInput.classList.remove('input-error');
            } else {
                emailInput.classList.add('input-error');
            }
        });
    }
});