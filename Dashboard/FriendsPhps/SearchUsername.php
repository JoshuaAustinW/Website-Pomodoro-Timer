<?php
    session_start();

    require '../../db.php';

    if (isset($_GET['query'])) {
        $userid = $_SESSION['user_id'];
        $query = $_GET['query'];
        $stmt = $conn->prepare("SELECT id, username FROM users WHERE username LIKE ? AND id != ?");
        $searchTerm = "%$query%";
        $stmt->bind_param("si", $searchTerm, $userid);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="ResultItemBox">
                        <div class="ResultName" id="ResultName">
                            Name: '.$row['username'].'
                        </div>

                        <div class="AddFriendButtonContainer">
                            <button class="FriendsButton AddFriendPopupButton" id="AddFriendButton'.$row['id'].'" onclick="sendFriendRequest('.$row['id'].')">Add Friend</button>
                            <div class="loader popupnote" id="loaderAddfriend'.$row['id'].'"></div>
                        </div>
                    </div>';
            }
        } else {
            echo '<h1 style="color: rgba(255, 255, 255, 0.3); font-size:30px;">Username not found.</h1>';
        }
        $stmt->close();
    }
    
    $conn->close();
