<?php
session_start();
include "database/db.php";
$email = $_POST['email'] ?? $_SESSION['email'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $password1 = filter_input(INPUT_POST, "password1", FILTER_SANITIZE_SPECIAL_CHARS);
        $password2 = filter_input(INPUT_POST, "password2", FILTER_SANITIZE_SPECIAL_CHARS);
        
        $sql = "SELECT * FROM users WHERE email=?";
        $stmt = $conn1->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        echo"$email";
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password1,$row['password'])){
                $hashed_password = password_hash($password2, PASSWORD_DEFAULT);
                $update_sql = "UPDATE users SET password=? WHERE email=?";
                $update_stmt = $conn1->prepare($update_sql);
                $update_stmt->bind_param("ss", $hashed_password, $email);
                if ($update_stmt->execute()) {
                    $_SESSION["valid"] = "valid";
                    $_SESSION['message'] = "Password updated successfully, Please Login";
                    $_SESSION["login"] = false;
                    header("Location: ../login.php");
                    exit();
                }
            }
            else if($_POST['name'] == $row['username']){
                $update_sql = "UPDATE users SET password=? WHERE email=?";
                $update_stmt = $conn1->prepare($update_sql);
                $update_stmt->bind_param("ss", $hashed_password, $email);
                if ($update_stmt->execute()) {
                    $_SESSION["valid"] = "valid";
                    $_SESSION['message'] = "Password updated successfully, Please Login";
                    $_SESSION["login"] = false;
                    header("Location: ../login.php");
                    exit();
                }
            }
            else{
                $_SESSION['message'] = "Please Enter correct password $email";
                header("Location: ../login.php");
                exit();
            }
        } else {
            $_SESSION['message'] = "No user found with given Email";
            header("Location: ../login.php");
            exit();
        }
    } 

mysqli_close($conn1);