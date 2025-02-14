<?php
session_start();
include "database/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["email"]) && !empty($_POST["password"])) {
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn1, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password,$row['password'])) {
                $_SESSION["username"] = $row['username'];
                $_SESSION["image_path"]=$row['photo'];
                $_SESSION["login"]=true;
                $role = $row['role'];
                switch ($role) {
                    case "user":
                        $_SESSION["email"] = $email;
                        header("Location: ../userhome.php");
                        exit();
                    case "admin":
                        header("Location: ../admin/adminHome.php");
                        exit();
                }
            } else {
                $_SESSION['message'] = "Invalid password";
                $_SESSION["login"]=false;
                header("Location: ../login.php");
                exit();
            }
        } else {
            $_SESSION['message'] = "No user found";
            header("Location: ../login.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "Please fill in all fields";
        header("Location: ../login.php");
        exit();
    }
}

mysqli_close($conn1);