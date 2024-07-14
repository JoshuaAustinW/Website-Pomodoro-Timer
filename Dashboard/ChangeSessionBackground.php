<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['BackgroundURL'])) {
    $backgroundURL = filter_input(INPUT_POST, 'BackgroundURL', FILTER_SANITIZE_URL);
    $_SESSION['BackgroundURL'] = $backgroundURL;
    setcookie('BackgroundURL', $backgroundURL, time() + (86400 * 30), "/");
}