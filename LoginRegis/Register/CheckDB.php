<?php
    require '../../db.php';
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $email = htmlspecialchars(strtolower(trim($_POST['email'])));
        $username = htmlspecialchars(strtolower(trim($_POST['username'])));


        //Parsing Data Purpose
        $_SESSION['regis_username'] = trim($_POST['username']);
        $_SESSION['regis_password'] = $_POST['password'];
        $_SESSION['regis_email'] = trim($_POST['email']);
        
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $stmt->close();

            $_SESSION['message'] = "username/email exists! please make a different username.";
            echo "  <script type='text/javascript'>
                        window.location.href = 'Register.php';
                    </script>";
        } else {

                $stmt->close();

                $_SESSION['regis_confirmpassword'] = $_POST['confirmpassword'];
                $_SESSION['OpenOTPCommand'] = 
                "<script> 
                
                var RegisButton = document.getElementById('RegisButton');
                var loader = document.getElementById('loader');

                loader.style.display = 'flex';
                RegisButton.style.display = 'none';

                setTimeout(function() { OpenOTP(); }, 100); 
                
                </script>";

                header("Location: Register.php");

        }
        
    } else {
        $alert = "Error sending data... please try again!";
        echo "  <script type='text/javascript'>
                    alert('$alert');
                    window.location.href = 'Register.php';
                </script>                                           ";
    }
    
    
    $conn->close();
