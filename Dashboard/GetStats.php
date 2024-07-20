<?php
session_start();
require '../db.php';

$user_id = $_SESSION['user_id'];


$range = isset($_GET['range']) ? $_GET['range'] : 'all';

switch($range) {
    case '7days':
        $sql = "SELECT SUM(session_duration) as session_duration, DATE(date) as date 
                FROM pomodoro_sessions 
                WHERE user_id = ? AND date >= DATE_SUB(CURDATE(), INTERVAL 3 DAY) 
                GROUP BY DATE(date) 
                ORDER BY date";
        break;
    case 'biweekly':
        $sql = "SELECT SUM(session_duration) as session_duration, DATE(date) as date 
                FROM pomodoro_sessions 
                WHERE user_id = ? AND date >= DATE_SUB(CURDATE(), INTERVAL 14 DAY) 
                GROUP BY DATE(date) 
                ORDER BY date";
        break;
    case 'monthly':
        $sql = "SELECT SUM(session_duration) as session_duration, DATE(date) as date 
                FROM pomodoro_sessions 
                WHERE user_id = ? AND date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) 
                GROUP BY DATE(date) 
                ORDER BY date";
        break;
    default:
        $sql = "SELECT SUM(session_duration) as session_duration, DATE(date) as date 
                FROM pomodoro_sessions 
                WHERE user_id = ? 
                GROUP BY DATE(date) 
                ORDER BY date";
}

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
?>