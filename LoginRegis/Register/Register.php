<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="stylesheet" href="../Login/Login.css">
    <link rel="stylesheet" href="Register.css">
    <script src="../../index.js"></script>
    <script src="../Preventchars.js"></script>
    <script src="Register.js"></script>
    <script src="https://kit.fontawesome.com/0020352476.js" crossorigin="anonymous"></script>
    <script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js">
    </script>

    <script type="text/javascript">

        (function(){
            emailjs.init({
                publicKey: "FnxWexuRuEjWjkilJ",
            });
        })();

    </script>
</head>
<body>


<?php 

session_start();

?>

    <div class="wrapper">

        <div class="whitebox">

            <div class="x-wrapper"> <i class="fa-solid fa-x" onclick="OpenPage('../../index.php')"></i> </div>

            <form id="formRegis" class="LoginRegisForm" method="POST" action="">

                <div class="FormTitle"> <b>Register</b></div>

                <label class="InputLabel" for="username">Username<br></label>
                <input id="username" class="InputText" style="margin-bottom: 5%;" name="username" placeholder="Type your username" type="text" onkeypress="usernameInputFilter(event)" maxlength="50" required onpaste="return false;" autocomplete="off" value="<?php if (isset($_SESSION['regis_username'])) { echo $_SESSION['regis_username']; unset($_SESSION['regis_username']);} else echo ''; ?>">

                <label class="InputLabel" for="email">Email<br></label>
                <input id="email" class="InputText" style="margin-bottom: 5%;" name="email" placeholder="Type your email" type="email" onkeypress="preventSpace(event)" maxlength="50" required onpaste="return false;" value="<?php if (isset($_SESSION['regis_email'])) { echo $_SESSION['regis_email']; unset($_SESSION['regis_email']);} else echo ''; ?>">

                <label class="InputLabel" for="password">Password<br></label>
                
                <input id="password" class="InputText" style="margin-bottom: 5%;" name="password" placeholder="Type your password" type="password" onkeypress="preventSpace(event)" maxlength="50" required onpaste="return false;" value="<?php if (isset($_SESSION['regis_password'])) { echo $_SESSION['regis_password']; unset($_SESSION['regis_password']);} else echo ''; ?>">

                <label class="InputLabel" for="confirmpassword">Confirm Password<br></label>
                <div class="passwordContainer">
                    <input id="confirmPassword" class="InputText password" style="margin-bottom: 5%;" name="confirmpassword" placeholder="Confirm your password" type="password" onkeypress="preventSpace(event)" maxlength="50" required onpaste="return false;" value="<?php if (isset($_SESSION['regis_confirmpassword'])) { echo $_SESSION['regis_confirmpassword']; unset($_SESSION['regis_confirmpassword']);} else echo ''; ?>">
                    <i class="show-password-icon fas fa-eye-slash" id="ShowPassword"></i>
                </div>

                <div id="errorMessages" style="font-size: 15px; text-align: center; margin-bottom: 5%; color: red;">
                    <?php
                        if (isset($_SESSION['message'])) {
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                        }
                    ?>
                </div>

                <input id="RegisButton" type="button" class="button" value="Register" onclick="checkInput()">
                <div class="loader" id="loader"></div>

            </form>

            <div class="Signin">Have an account already? <a href="../Login/Login.php" target="_self" class="Remembermetext ForgotPassword">Sign In!</a></div>

        </div>
    
        
    </div>


    <div class="BackgroundBlur hidden" id="BackgroundBlur"></div>

    <div class="BoxOTP hidden" id="BoxOTP">
        <div class="xbuttonwrapperOTP">    <i class="fa-solid fa-x OTP" onclick="CloseOTP();"></i>  </div>

        <div class="formOTP" name="formOTP">
            <h1 class="OTPTitle">We've sent the OTP code to your email</h1>
            <input id="OTPInput" name="OTPInput" placeholder="Input your OTP" class="OTPInput" type="text" maxlength="6" autocomplete="off">
            
            <div class="OTPErrorWrapper"> <div id="OTPError"></div> </div>
                        
            <input class="ButtonSubmit" id="ButtonSubmit" type="button" value="Submit" onclick="VerifyOTP()">
            <input class="ButtonSubmit Resend" id="ButtonResend" type="button" value="Resend" onclick="ResendOTP()">
            <div class="loader" id="loaderOTP"></div>
        </div>

        <div class="countdown" id="countdown"></div>

    </div>


<!--    Parsing Data Purpose    -->
    <form action="" method="post" id="hiddenform">
        <input type="hidden" id="hidden_email" name="hidden_email">
        <input type="hidden" id="hidden_username" name="hidden_username">
        <input type="hidden" id="hidden_password" name="hidden_password">
    </form>


<?php
    if (isset($_SESSION['OpenOTPCommand'])) {

        echo $_SESSION['OpenOTPCommand'];
        unset($_SESSION['OpenOTPCommand']);
    }
?>

</body>
</html>