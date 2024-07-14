<?php
session_start();

if (isset($_POST['embedURL'])) {
    $_SESSION['embedURL'] = $_POST['embedURL'];
}