<?php
include "./database/db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $query1 = "UPDATE admissions SET status = ? WHERE id = ?";
    $stmt = $conn1->prepare($query1);
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Status updated successfully!";
        header("Location: ../admin/adminHome.php"); 
        exit();
    } else {
        $_SESSION['message'] = "Failed to update status.";
    }
}