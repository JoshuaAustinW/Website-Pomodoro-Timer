<?php

session_start();
require '../../db.php';

$user_id = $_SESSION['user_id'];
$friend_id = $_POST['friend_id'];

$sql = "DELETE FROM friends WHERE user_id = ? AND friend_id = ? AND status = 'pending'";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $user_id, $friend_id);

if ($stmt->execute()) {
    echo "Canceled";
} else {
    echo $stmt->error;
}

$stmt->close();
$conn->close();