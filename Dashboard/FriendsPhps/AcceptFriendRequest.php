<?php
session_start();
require '../../db.php';

$user_id = $_SESSION['user_id'];
$friend_id = $_POST['friend_id'];

$sql = "UPDATE friends SET status='accepted' WHERE user_id=? AND friend_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $friend_id, $user_id);

if ($stmt->execute()) {
    echo "Friend request accepted!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();