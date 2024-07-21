<?php
session_start();
require '../../db.php';

$user_id = $_SESSION['user_id'];
$friend_id = $_POST['friend_id'];

$sql = "DELETE FROM friends WHERE (user_id = ? AND friend_id = ?) OR (user_id = ? AND friend_id = ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('iiii', $user_id, $friend_id, $friend_id, $user_id);

if ($stmt->execute()) {
    echo "Friend removed!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();