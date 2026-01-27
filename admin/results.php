<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$user_id=$_SESSION['user_id'];
    include "./login-register/database/db.php";
    if ($conn->connect_error) {
        die("Connection failed: {$conn->connect_error}");
    }

    $sql = "SELECT * FROM results WHERE user_id='$user_id'";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/cards.css">
    <link rel="icon" href="assets/kn_seal.png" type="image/x-icon">
    <title>Results - Bangalore University</title>
</head>
<body>
    <div class="cards">
        <div class="card1">
            <div class="s1 card">
                <h1>RESULTS</h1>
            </div>
            <center>
                <hr>
            </center>
            <div class="r2 card">
                <?php
                    if ($result->num_rows > 0) {
                        echo "<table border='1'>";
    echo "<tr>
            <th>S.No</th>
            <th>Subject</th>
            <th>Max</th>
            <th>Min</th>
            <th>Scored</th>
            <th>Internal</th>
            <th>Total</th>
            <th>Status</th>
            <th>Credits</th>
            <th>Grade Points</th>
        </tr>";
    $i=0;
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr class='row-" . $row['id'] . "'>";
        echo "<td>" . $i + 1 . "</td>";
        echo "<td>" . $row['subject'] . "</td>";
        echo "<td>" . $row['max_marks'] . "</td>";
        echo "<td>" . $row['min_marks'] . "</td>";
        echo "<td>" . $row['scored_marks'] . "</td>";
        echo "<td>" . $row['internal_marks'] . "</td>";
        echo "<td>" . $row['total_marks'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        echo "<td>" . $row['credits'] . "</td>";
        echo "<td>" . $row['grade'] . "</td>";
        $i++;
                        }
                        echo "</table><br>";
                        
                    } else {
                        echo "0 results";
                    }
                    $conn->close();
                ?>
            </div>
            <div id="btns">
                <form action="edits.php" method="post">
                    <button class="edit" name="user_id" type="submit" value="<?php echo $user_id?>">Edit</button>
                </form>
                <button class="back" onclick="window.location.href='adminhome.php?value=resultview.php'" >Back</button>
            </div>
        </div>
    </div>
</body>
</html>