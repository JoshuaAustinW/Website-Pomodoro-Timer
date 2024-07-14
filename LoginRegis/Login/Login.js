function ShowLoader(){
    var LoginButton = document.getElementById('LoginButton');
    var loader = document.getElementById('loader');
    var form = document.getElementById('LoginRegisForm');

    LoginButton.style.display = 'none';
    loader.style.display = 'flex';
    form.action = 'Authenticate.php';
    form.submit();
}


        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('InputPassword');
            const showPasswordIcon = document.getElementById('ShowPassword');

            showPasswordIcon.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    showPasswordIcon.classList.remove('fa-eye-slash');
                    showPasswordIcon.classList.add('fa-eye');
                } else {
                    passwordInput.type = 'password';
                    showPasswordIcon.classList.remove('fa-eye');
                    showPasswordIcon.classList.add('fa-eye-slash');
                }
            });
        });