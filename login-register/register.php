<?php 
session_start();
include "database/db.php";
require_once 'database/cloudinary.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password1 = filter_input(INPUT_POST, "password1", FILTER_SANITIZE_SPECIAL_CHARS);
    $password2 = filter_input(INPUT_POST, "password2", FILTER_SANITIZE_SPECIAL_CHARS);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_SPECIAL_CHARS);

    $path = isset($_GET['value']) && $_GET['value'] == 1 ? "Location: ../admin/adminHome.php" : "Location: ../login.php";

    // Default profile image
    $photo = "https://res.cloudinary.com/YOUR_CLOUD_NAME/image/upload/default.jpeg";

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {

        $allowed = ['jpg', 'jpeg', 'png'];
        $ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed)) {
            $_SESSION['message'] = "Only JPG, JPEG, PNG allowed";
            header("Location: ../register.php");
            exit();
        }

        $uploadedUrl = uploadToCloudinary($_FILES['photo']['tmp_name']);

        if ($uploadedUrl) {
            $photo = $uploadedUrl;
        }
    }


    if ($password1 == $password2) {
        $hash = password_hash($password1, PASSWORD_DEFAULT);

        $stmt = $conn1->prepare("INSERT INTO users (email, username, password, phone, photo) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $email, $username, $hash, $phone, $photo);

        $stmt2 = $conn1->prepare(
            "INSERT INTO results
            (user_id, subject, max_marks, min_marks, scored_marks,
            internal_marks, total_marks, status, credits, grade)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );

        $subjects = [
            ['GENERIC ENGLISH', 100, 40, 49, 40, 87, 'Pass', 3, 8],
            ['GANAKA KANNADA', 100, 40, 27, 40, 67, 'Pass', 3, 6],
            ['DISCRETE STRUCTURE', 100, 40, 43, 40, 83, 'Pass', 3, 8],
            ['PROBLEM SOLVING TECHNIQUES', 100, 40, 45, 40, 85, 'Pass', 3, 8],
            ['DATA STRUCTURE', 100, 40, 28, 40, 68, 'Pass', 3, 7],
            ['FINANCIAL LITERACY', 100, 40, 21, 40, 61, 'Pass', 3, 6],
            ['PROBLEM SOLVING LAB', 50, 20, 24, 25, 49, 'Pass', 2, 10],
            ['DATA STRUCTURE LAB', 50, 20, 21, 25, 46, 'Pass', 2, 9],
            ['ENVIRONMENTAL STUDIES', 50, 20, 18, 20, 38, 'Pass', 2, 7],
            ['HEALTH AND WELLNESS', 25, 10, 0, 25, 25, 'Pass', 1, 10],
        ];

        try {
            $conn1->begin_transaction();

            $stmt->execute();
            $user_id = $stmt->insert_id;

            foreach ($subjects as $s) {
                $stmt2->bind_param(
                    "isiiiiisii",
                    $user_id, $s[0], $s[1], $s[2], $s[3],
                    $s[4], $s[5], $s[6], $s[7], $s[8]
                );
                $stmt2->execute();
            }

            $conn1->commit();

            $_SESSION['message'] = "You are now registered, Please Login";
            header($path);
            exit();
        } catch (mysqli_sql_exception $e) {
            $conn1->rollback();

            $_SESSION['message'] = "Error: " . $e->getMessage();
            header($path);
            exit();
        }
    } else {
        $_SESSION['message'] = "Password Don't Match";
        header($path);
        exit();
    }
}

mysqli_close($conn1);
mysqli_close($conn2);