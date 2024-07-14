<?php
    require '../../db.php';
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = htmlspecialchars(strtolower(trim($_POST['hidden_email'])));
        $password = password_hash($_POST['hidden_password'], PASSWORD_DEFAULT);

        $sql = "UPDATE users SET password = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }

        $stmt->bind_param('ss', $password, $email);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            header("Location: ../Login/Login.php");
        } else {
            $stmt->close();
            $conn->close();
            $_SESSION['Passworderror'] = "Error updating password: " . $stmt->error;
            header("Location: ForgotPassword.php");
        }
    }

