<?php

    require '../../db.php';

    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['email'];
        $password = $_POST['password'];
        $remember_me = isset($_POST['remember_me']);
    
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
    
    
        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();
            $stored_hash = $row['password'];
    
    
            if (password_verify($password,  $stored_hash)) {

                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['email'] = $row['email'];

                if ($remember_me) {
                    setcookie('remember_me', $row['id'], time() + (86400 * 30), "/"); // 30 days
                    setcookie('username', $row['username'], time() + (86400 * 30), "/");
                    setcookie('email', $row['email'], time() + (86400 * 30), "/");
                }

                header("Location: ../../Dashboard/Dashboard.php"); //Change to dashboard
                $stmt->close();
                exit();
                
            } else {
                $_SESSION['error'] = 'Wrong Password, Please Try Again.';
                header("Location: Login.php");
                $stmt->close();
                exit();
            }
            
        } else {
            $_SESSION['error'] = 'Email Doesnt Exist! Please make an account if you haven\'t already.';
            header("Location: Login.php");
            $stmt->close();
            exit();
        }
    }
    
    $conn->close();
