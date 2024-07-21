<?php
    session_start();
    require '../../db.php';

    $user_id = $_SESSION['user_id'];

    $sql = "SELECT users.id, users.username FROM friends JOIN users ON friends.friend_id = users.id WHERE friends.user_id = ? AND friends.status = 'pending'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $response = '';

    while ($row = $result->fetch_assoc()) {
        $response .= '<div class="FriendsItemBox">
                            <div class="FriendName">Name: '.$row['username'].'<br>Status: Pending</div>
                            <div class="ButtonsFriends">
                                <button class="FriendsButton Cancelation" onclick="CancelRequest('.$row['id'].')">Cancel</button>
                            </div>
                        </div>';
    }
    echo $response;