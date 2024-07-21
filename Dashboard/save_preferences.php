<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and save focus time
    if (isset($_POST['focusTime'])) {
        $focusTime = filter_input(INPUT_POST, 'focusTime', FILTER_SANITIZE_NUMBER_INT);
        $_SESSION['focusTime'] = $focusTime;
        setcookie('focusTime', $focusTime, time() + (86400 * 30), "/");
    }

    // Sanitize and save short break
    if (isset($_POST['shortBreak'])) {
        $shortBreak = filter_input(INPUT_POST, 'shortBreak', FILTER_SANITIZE_NUMBER_INT);
        $_SESSION['shortBreak'] = $shortBreak;
        setcookie('shortBreak', $shortBreak, time() + (86400 * 30), "/");
    }

    // Sanitize and save long break
    if (isset($_POST['longBreak'])) {
        $longBreak = filter_input(INPUT_POST, 'longBreak', FILTER_SANITIZE_NUMBER_INT);
        $_SESSION['longBreak'] = $longBreak;
        setcookie('longBreak', $longBreak, time() + (86400 * 30), "/");
    }

    // Save auto sequence
    if (isset($_POST['autoSequence'])) {
        $autoSequence = $_POST['autoSequence'] === 'true' ? 'true' : 'false';
        $_SESSION['autoSequence'] = $autoSequence;
        setcookie('autoSequence', $autoSequence, time() + (86400 * 30), "/");
    }

    // Sanitize and save timer mode
    if (isset($_POST['timerMode'])) {
        $timerMode = filter_input(INPUT_POST, 'timerMode', FILTER_SANITIZE_STRING);
        $_SESSION['timerMode'] = $timerMode;
        setcookie('timerMode', $timerMode, time() + (86400 * 30), "/");
    }

    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}