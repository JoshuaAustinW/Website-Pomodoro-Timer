<?php
session_start();
    require '../db.php';

    $user_id = $_SESSION['user_id'];

    $sql = "SELECT session_duration, date FROM pomodoro_sessions WHERE user_id = ? ORDER BY date";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $sessions = array();

    while ($row = $result->fetch_assoc()) {
        $row['date'] = date('Y-m-d', strtotime($row['date']));
        $sessions[] = $row;
    }

    echo json_encode($sessions);

    $stmt->close();
    $conn->close();