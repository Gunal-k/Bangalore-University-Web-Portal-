<?php
session_start();
include "../login-register/database/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];

    $subjects = $_POST['subject'];
    $max = $_POST['max'];
    $min = $_POST['min'];
    $scored = $_POST['scored'];
    $internal = $_POST['internal'];
    $total = $_POST['total'];
    $status = $_POST['status'];
    $credits = $_POST['credits'];
    $grade = $_POST['grade'];

    $update_success = true;

    for ($i = 0; $i < count($subjects); $i++) {
        $sql = "UPDATE `$username` SET 
                subject = ?, 
                max = ?, 
                min = ?, 
                scored = ?, 
                internal = ?, 
                total = ?, 
                status = ?, 
                credits = ?, 
                grade = ? 
                WHERE sno = ?";

        $stmt = $conn2->prepare($sql);
        $sno = $i + 1;
        $stmt->bind_param("siiiiisiii", 
            $subjects[$i], 
            $max[$i], 
            $min[$i], 
            $scored[$i], 
            $internal[$i], 
            $total[$i], 
            $status[$i], 
            $credits[$i], 
            $grade[$i],
            $sno
        );

        if (!$stmt->execute()) {
            $_SESSION['error_message'] = "Error updating record for S.No " . ($i + 1) . ": " . $conn2->error;
            $update_success = false;
            break;
        }

        $stmt->close();
    }

    $conn2->close();

    if ($update_success) {
        $_SESSION['success_message'] = "Records updated successfully!";
    }

    header("Location: ../admin/results.php?username=$username");
    exit();
}
