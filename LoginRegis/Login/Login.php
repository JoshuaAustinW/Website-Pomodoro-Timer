<?php
    session_start();

    if (isset($_SESSION['user_id'])) {
        header("Location: ../../Dashboard/Dashboard.php");
        exit();
    } else if (isset($_COOKIE['remember_me'])) {
        $_SESSION['user_id'] = $_COOKIE['remember_me'];
        $_SESSION['username'] = $_COOKIE['username'];
        $_SESSION['email'] = $_COOKIE['email'];
        header("Location: ../../Dashboard/Dashboard.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="Login.css">
    <script src="Login.js"></script>
    <script src="../../index.js"></script>
    <script src="../Preventchars.js"></script>
    <script src="https://kit.fontawesome.com/0020352476.js" crossorigin="anonymous"></script>
</head>
<body>

    <div class="wrapper">

        <a href="../../index.php" style="text-decoration: none" class="Title">DORO</a>

        <div class="whitebox">

            <div class="x-wrapper"> <i class="fa-solid fa-x" onclick="OpenPage('../../index.php')"></i> </div>

            <form id="LoginRegisForm" class="LoginRegisForm" method="post" action="">

                <div class="FormTitle">Hello, <br> <b>Welcome</b></div>

                <label class="InputLabel" for="email">Email<br></label>
                <input class="InputText" style="margin-bottom: 5%;" name="email" placeholder="Type your email" type="email" onkeypress="preventSpace(event)" maxlength="50" required onpaste="return false;">

                <label class="InputLabel" for="password">Password<br></label>
                <div class="passwordContainer">
                    <input class="InputText password" id="InputPassword" style="margin-bottom: 3%;" name="password" placeholder="Type your password" type="password" onkeypress="preventSpace(event)" maxlength="50" required onpaste="return false;">
                    <i class="show-password-icon fas fa-eye-slash" id="ShowPassword"></i>
                </div>

                <div class="ForgotRememberWrapper">
                    <div class="RememberMeWrapper">
                        <input type="checkbox" name="remember_me"><label class="Remembermetext" for="rememberme">Remember Me</label> 
                    </div>

                    <div class="ForgotWrapper"><a href="../ForgorPassword/ForgotPassword.php" target="_self" class="Remembermetext ForgotPassword">Forgot Password</a></div>
                </div>

                <div id="errorMessages" style="font-size: 15px; text-align: center; margin-bottom: 5%; color: red;">
                    <?php
                        if (isset($_SESSION['error'])) {
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                        }
                    ?>
                </div>

                <input id="LoginButton" type="button" class="button" value="Login" onclick="ShowLoader()">
                <div class="loader" id="loader"></div>
            </form>

            <div class="Signup">Don’t have an account? <a href="../Register/Register.php" target="_self" class="Remembermetext ForgotPassword">Sign Up!</a></div>

        </div>
    
        
    </div>

</body>
</html>