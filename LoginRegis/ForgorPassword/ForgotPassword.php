<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>

    <link rel="stylesheet" href="../Login/Login.css">
    <link rel="stylesheet" href="../Register/Register.css">
    <link rel="stylesheet" href="ForgotPassword.css">
    <script src="../../index.js"></script>
    <script src="ForgotPassword.js"></script>
    <script src="../Preventchars.js"></script>
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

    <div class="wrapper">

        <a href="../../index.php" style="text-decoration: none" class="Title">DORO</a>

        <div class="whitebox">

            <div class="x-wrapper"> <i class="fa-solid fa-x" onclick="OpenPage('../../index.php')"></i> </div>

            <form id="ForgotPasswordForm" class="LoginRegisForm" method="post" action="">

                <div class="FormTitle">Change your <br> <b>Password</b></div>

                <label class="InputLabel" for="email">Email<br></label>
                <input class="InputText" style="margin-bottom: 5%;" id="email" name="email" placeholder="Type your email" type="email" onkeypress="preventSpace(event)" maxlength="50" required onpaste="return false;" value="<?php if (isset($_SESSION['forgot_email'])) { echo $_SESSION['forgot_email']; unset($_SESSION['forgot_email']);} else echo ''; ?>">

                <label class="InputLabel" for="password">New Password<br></label>
                <input class="InputText" id="InputPassword" style="margin-bottom: 3%;" name="password" placeholder="Type your password" type="password" onkeypress="preventSpace(event)" maxlength="50" required onpaste="return false;" value="<?php if (isset($_SESSION['forgot_password'])) { echo $_SESSION['forgot_password']; unset($_SESSION['forgot_password']);} else echo ''; ?>">

                <label class="InputLabel" for="InputConfirmPassword">Confirm Password<br></label>
                <div class="passwordContainer">
                    <input class="InputText password" id="InputConfirmPassword" style="margin-bottom: 3%;" name="confirmpassword" placeholder="Type your password" type="password" onkeypress="preventSpace(event)" maxlength="50" required onpaste="return false;" value="<?php if (isset($_SESSION['forgot_confirmpassword'])) { echo $_SESSION['forgot_confirmpassword']; unset($_SESSION['forgot_confirmpassword']);} else echo ''; ?>">
                    <i class="show-password-icon fas fa-eye-slash" id="ShowPassword"></i>
                </div>

                <div id="errorMessages" style="font-size: 15px; text-align: center; margin-bottom: 5%; color: red;">
                    <?php
                        if (isset($_SESSION['Passworderror'])) {
                            echo $_SESSION['Passworderror'];
                            unset($_SESSION['Passworderror']);
                        }
                    ?>
                </div>

                <input id="ChangePassButton" type="button" class="button" value="Change password" onclick="CheckDB()">
                <div class="loader" id="loader"></div>
            </form>

            <div class="Signup">Don’t have an account? <a href="../Register/Register.php" target="_self" class="Remembermetext ForgotPassword">Sign Up!</a></div>

        </div>
    
        
    </div>

    <div class="BackgroundBlur hidden" id="BackgroundBlur"></div>

    <div class="BoxOTP hidden" id="BoxOTP">
        <div class="xbuttonwrapperOTP">    <i class="fa-solid fa-x OTP" onclick="CloseOTP()"></i>  </div>

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
        <input type="hidden" id="hidden_password" name="hidden_password">
    </form>


<?php
    if (isset($_SESSION['OpenOTPCommand_ForgotMyPassword'])) {

        echo $_SESSION['OpenOTPCommand_ForgotMyPassword'];
        unset($_SESSION['OpenOTPCommand_ForgotMyPassword']);
    }
?>

</body>
</html>