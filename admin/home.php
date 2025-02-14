<?php
    include "../login-register/database/db.php";
    if ($conn1->connect_error) {
        die("Connection failed: " . $conn1->connect_error);
    }
    
    $sql1 = "SELECT count(*) as total FROM users where role='user'";
    $result1 = $conn1->query($sql1);
    $user_total = ($result1) ? $result1->fetch_assoc()["total"] : 0;    

    $sql2 = "SELECT COUNT(*) AS total_tables FROM information_schema.tables WHERE table_schema = 'student_db';";
    $result2 = $conn2->query($sql2);
    $res_total = ($result2) ? $result2->fetch_assoc()["total_tables"] : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../styles/adminhome.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="section1">
        <div class="cards">
            <div class="card1" onclick="loadPage('cards')">
                <div class="s1 card">
                    <img src="../assets/group.png" alt="users" class="icon">
                    <h2>Total Registered Students</h2>
                </div>
                <hr>
                <div class="r2 card">
                    <h3><?php echo $user_total ?></h3>
                </div>
            </div>
            <div class="card2" onclick="loadPage('resultview')">
                <div class="s2 card">
                    <img src="../assets/result.png" alt="result" class="icon">
                    <h2>Total Results</h2>
                </div>
                <hr>
                <div class="r2 card">
                    <h3><?php echo $res_total ?></h3>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
