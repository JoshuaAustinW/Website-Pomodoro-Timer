<?php

    session_start();
    require '../../db.php';

    $user_id = $_SESSION['user_id'];
    $friend_id = $_POST['friend_id'];

    $sql_check = "SELECT * FROM friends WHERE (user_id = ? AND friend_id = ?) OR (user_id = ? AND friend_id = ?)";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param('iiii', $user_id, $friend_id, $friend_id, $user_id);
    $stmt_check->execute();
    $result = $stmt_check->get_result();

    if ($result->num_rows > 0) {
        echo "Friend request already sent or already friends!";
    } else {
        // Insert new friend request
        $sql_insert = "INSERT INTO friends (user_id, friend_id, status) VALUES (?, ?, 'pending')";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param('ii', $user_id, $friend_id);

        if ($stmt_insert->execute()) {
            echo "Friend request sent!";
        } else {
            echo "Error: " . $stmt_insert->error;
        }

        $stmt_insert->close();
    }

    $stmt_check->close();
    $conn->close();
