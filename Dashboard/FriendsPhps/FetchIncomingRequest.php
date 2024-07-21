<?php

session_start();
require '../../db.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT users.id, users.username FROM friends JOIN users ON friends.user_id = users.id WHERE friends.friend_id = ? AND friends.status = 'pending'";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

$response = '';

while ($row = $result->fetch_assoc()) {
    $response .= '      <div class="FriendsItemBox">
                            <div class="FriendName">Name: '.$row['username'].'<br>Incoming request!</div>
                            <div class="ButtonsFriends">
                                <button class="FriendsButton Cancelation Accept" onclick="AcceptRequest('.$row['id'].')">Accept</button>
                                <button class="FriendsButton Cancelation" onclick="DeclineRequest('.$row['id'].')">Decline</button>
                            </div>
                        </div>';
}

echo $response;

$stmt->close();
$conn->close();