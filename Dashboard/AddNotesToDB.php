<?php
    session_start();
    require '../db.php';

    $response = array("status" => "error", "message" => "Unknown error", "command" => "");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $Title = $_POST['title'];
        $Content = $_POST['content'];
        $noteId = $_POST['note_id'];
        $user_id = $_SESSION['user_id'];

        if($noteId==""){
            $stmt = $conn->prepare("INSERT INTO notes (user_id, title, content) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $user_id, $Title, $Content);


            if ($stmt->execute()) {
                $response["status"] = "success";
                $response["message"] = "Note saved successfully";
                $response["command"] = "
                        CloseNotePopup();
                        OpenMenu();
                        ChangeMenuNote();
                ";
            }
            else {
                $response["message"] = "Error saving note...";
            }

            $stmt->close();
        }
        else{
            $sql = "UPDATE notes SET title='$Title', content='$Content' WHERE id=$noteId";
            if ($conn->query($sql) === TRUE) {
                $response["status"] = "success";
                $response["message"] = "Note updated successfully";
                $response["command"] = "
                        CloseNotePopup();
                        OpenMenu();
                        ChangeMenuNote();
                ";
            }
            else {
                $response["message"] = "Failed to update note";
            }

        }

        $conn->close();
        echo json_encode($response);
    }