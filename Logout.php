<?php
    session_start();
    session_unset();
    session_destroy();
    setcookie('remember_me', '', time() - 3600, "/");
    setcookie('email', '', time() - 3600, "/");

    header("Location: LoginRegis/Login/Login.php");
    exit();
