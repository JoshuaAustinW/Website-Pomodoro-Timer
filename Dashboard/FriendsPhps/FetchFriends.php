<?php
session_start();
require '../../db.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT users.id, users.username 
        FROM friends 
        JOIN users ON (friends.user_id = users.id OR friends.friend_id = users.id) 
        WHERE (friends.user_id = ? OR friends.friend_id = ?) 
        AND friends.status = 'accepted' 
        AND users.id != ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('iii', $user_id, $user_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

$response = '';
while ($row = $result->fetch_assoc()) {
    $response .= '      <div class="FriendsItemBox">
                            <div class="FriendName">Name: '.$row['username'].'<br>Status: Friends!</div>
                            <div class="ButtonsFriends">
                                <button class="FriendsButton Cancelation" onclick="RemoveFriend('.$row['id'].')">Remove</button>
                            </div>
                        </div>';
}

echo $response;

$stmt->close();
$conn->close();