<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $_SESSION['regis_username'] = $_POST['hidden_username'];
    $_SESSION['regis_password'] = $_POST['hidden_password'];
    $_SESSION['regis_email'] = $_POST['hidden_email'];

    header("Location: AddToDB.php");

}