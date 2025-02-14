<?php 
session_start();
include "database/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password1 = filter_input(INPUT_POST, "password1", FILTER_SANITIZE_SPECIAL_CHARS);
    $password2 = filter_input(INPUT_POST, "password2", FILTER_SANITIZE_SPECIAL_CHARS);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $uname = '';

    $path = isset($_GET['value']) && $_GET['value'] == 1 ? "Location: ../admin/adminHome.php" : "Location: ../login.php";
    
    function generateUniqueId() {
        return 'ID-' . time() . '-' . rand(1000, 9999);
    }

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['photo']['tmp_name'];
        $fileName = $_FILES['photo']['name'];
        $fileSize = $_FILES['photo']['size'];
        $fileType = $_FILES['photo']['type'];
        $base = generateUniqueId() . '_' . basename($fileName);
        $dest_path = './uploads/{$base}';

        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $uname = $base;
        } else {
            $uname = "default.jpeg";
        }
    } else {
        $uname = "default.jpeg";
    }

    if ($password1 == $password2) {
        $hash = password_hash($password1, PASSWORD_DEFAULT);

        $stmt = $conn1->prepare("INSERT INTO users (email, username, password, phone, photo) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $email, $username, $hash, $phone, $uname);



        $sql2 = "CREATE TABLE $username (
            sno INT AUTO_INCREMENT PRIMARY KEY,
            subject VARCHAR(255),
            max INT,
            min INT,
            scored INT,
            internal INT,
            total INT,
            status VARCHAR(10),
            credits INT,
            grade INT
        );";

        $sql3 = "
        INSERT INTO $username
        (subject, max, min, scored, internal, total, status, credits, grade)
        VALUES
        ('GENERIC ENGLISH', 100, 40, 49, 40, 87, 'Pass', 3, 8),
        ('GANAKA KANNADA', 100, 40, 27, 40, 67, 'Pass', 3, 6),
        ('DISCRETE STRUCTURE', 100, 40, 43, 40, 83, 'Pass', 3, 8),
        ('PROBLEM SOLVING TECHNIQUES', 100, 40, 45, 40, 85, 'Pass', 3, 8),
        ('DATA STRUCTURE', 100, 40, 28, 40, 68, 'Pass', 3, 7),
        ('FINANCIAL LITERACY', 100, 40, 21, 40, 61, 'Pass', 3, 6),
        ('PROBLEM SOLVING LAB', 50, 20, 24, 25, 49, 'Pass', 2, 10),
        ('DATA STRUCTURE LAB', 50, 20, 21, 25, 46, 'Pass', 2, 9),
        ('ENVIRONMENTAL STUDIES', 50, 20, 18, 20, 38, 'Pass', 2, 7),
        ('HEALTH AND WELLNESS', 25, 10, 0, 25, 25, 'Pass', 1, 10);";

        try {
            $conn1->begin_transaction();

            $stmt->execute();

            mysqli_query($conn2, $sql2);
            mysqli_query($conn2, $sql3);

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