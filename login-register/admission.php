<?php
session_start();
include "./database/db.php";
if ($conn1->connect_error) {
    die("Database connection failed: {$conn1->connect_error}");
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $phone = preg_match("/^[0-9]{10}$/", $_POST['phone']) ? $_POST['phone'] : null;
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $course = $_POST['course'];
    $address = htmlspecialchars(trim($_POST['address']));
    $marks = filter_var($_POST['marks'], FILTER_VALIDATE_INT, [
        "options" => ["min_range" => 0, "max_range" => 100]
    ]);

    if (!$name || !$email || !$phone || !$dob || !$gender || !$course || !$address || $marks === false) {
        echo "<script>alert('Invalid input! Please check your details and try again.'); window.history.back();</script>";
        exit();
    }


    $stmt = $conn1->prepare("INSERT INTO admissions (name, email, phone, dob, gender, course, address, marks) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssi", $name, $email, $phone, $dob, $gender, $course, $address, $marks);

    $path = isset($_SESSION["login"]) && $_SESSION["login"] ? "userhome" : "index";

    if ($stmt->execute()) {
        echo "<script>alert('Application submitted successfully!'); window.location.href='../{$path}.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error submitting application. Please try again.'); window.history.back();</script>";
        exit();
    }    
}
