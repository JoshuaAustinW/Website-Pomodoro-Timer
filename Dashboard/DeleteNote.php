<?php
    session_start();
    require '../db.php';

    $responseDelete = array("status" => "error", "message" => "Unknown error", "command" => "");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $noteId = $_POST['note_id'];
        $user_id = $_SESSION['user_id'];

        $sql = "DELETE FROM notes WHERE id=$noteId";

        if ($conn->query($sql) === TRUE) {
            $responseDelete["status"] = "success";
            $responseDelete["message"] = "Note deleted successfully";
            $responseDelete["command"] = "
                    ChangeMenuNote();
                    loader.style.display = 'none';
                    DeleteButton.style.display = 'flex';
            ";
        }
        else {
            $responseDelete["message"] = "Error deleting note...";
        }

        $conn->close();
        echo json_encode($responseDelete);
    }