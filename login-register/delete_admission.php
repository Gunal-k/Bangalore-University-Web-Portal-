<?php
    include "database/db.php";
    $user_id=$_POST['user_id'];
    $username = $_POST['username'];
    $query1="DELETE FROM users WHERE user_id={$user_id}";
    $query2="DROP TABLE IF EXISTS $username;
";
    try {
        mysqli_query($conn1, $query1);
        mysqli_query($conn2, $query2);
        $_SESSION['message'] = "User Record Deleted Successfully";
        header("Location: ../admin/adminHome.php");
        exit();
    } catch (mysqli_sql_exception $e) {
        $_SESSION['message'] = "Error: " . $e->getMessage();
        header("Location: ../admin/adminHome.php");
        exit();
    }