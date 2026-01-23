<?php
session_start();
include "../login-register/database/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];

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
        $sql = "UPDATE results SET 
                subject = ?, 
                max = ?, 
                min = ?, 
                scored = ?, 
                internal = ?, 
                total = ?, 
                status = ?, 
                credits = ?, 
                grade = ? 
                WHERE id = ? AND user_id = ?";

        $stmt = $conn2->prepare($sql);
        $sno = $i + 1;
        $stmt->bind_param("siiiiisiiii", 
            $subjects[$i], 
            $max[$i], 
            $min[$i], 
            $scored[$i], 
            $internal[$i], 
            $total[$i], 
            $status[$i], 
            $credits[$i], 
            $grade[$i],
            $sno,
            $user_id
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
