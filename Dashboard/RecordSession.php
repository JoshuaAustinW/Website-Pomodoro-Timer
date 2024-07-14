<?php
session_start();
require '../db.php';

$user_id = $_SESSION['user_id'];
$session_duration = $_POST['session_duration'];
$session_date = date('Y-m-d');

$sql = "INSERT INTO pomodoro_sessions (user_id, session_duration, date) VALUES (?, ?, ?)
        ON DUPLICATE KEY UPDATE session_duration = session_duration + VALUES(session_duration)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iis", $user_id, $session_duration, $session_date);

if ($stmt->execute()) {
    echo "Session recorded successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
