<?php
    require '../../db.php';
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = htmlspecialchars(strtolower(trim($_POST['email'])));
        $password =  $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $stmt->close();

            $_SESSION['forgot_email'] = $email;
            $_SESSION['forgot_password'] = $password;
            $_SESSION['forgot_confirmpassword'] = $confirmpassword;

            $_SESSION['OpenOTPCommand_ForgotMyPassword'] = "
            
            <script>
                var ChangePassButton = document.getElementById('ChangePassButton');
                var loader = document.getElementById('loader');

                loader.style.display = 'flex';
                ChangePassButton.style.display = 'none';

                setTimeout(function() { OpenOTP(); }, 100); 
            </script>
            
            ";

            header("Location: ForgotPassword.php");
        }
        else {

            $stmt->close();

            $_SESSION['Passworderror'] = 'The current email doesn\'t have an account yet. Please Sign Up. ';
            header("Location: ForgotPassword.php");
        }
    }
