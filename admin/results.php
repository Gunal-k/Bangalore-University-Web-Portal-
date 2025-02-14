<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$username=$_GET['username']??$_POST['username'];
include "..\login-register\database\db.php";
if ($conn2->connect_error) {
    die("Connection failed: {$conn2->connect_error}");
}

$sql = "SELECT * FROM $username";
$result = $conn2->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/cards.css">
    <link rel="icon" href="assets/kn_seal.png" type="image/x-icon">
    <title>Results - Bangalore University</title>
    <style>
        #btns{
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: -10px;
            margin-right: 20px;
        }
        .edit{
            border:none;
            padding: 12px;
            width: 100px;
            color: white;
            font-size: 20px;
            border-radius: 50px;
            background: brown;
            font-weight: bold;
            letter-spacing: 2px;
            cursor: pointer;
        }
        .back{
            border:none;
            padding: 12px;
            width: 100px;
            color: white;
            font-size: 20px;
            border-radius: 50px;
            background: red;
            font-weight: bold;
            letter-spacing: 2px;
            cursor: pointer;
        }
    </style>
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
                        
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr class='row-" . $row['sno'] . "'>";
                            echo "<td>" . $row['sno'] . "</td>";
                            echo "<td>" . $row['subject'] . "</td>";
                            echo "<td>" . $row['max'] . "</td>";
                            echo "<td>" . $row['min'] . "</td>";
                            echo "<td>" . $row['scored'] . "</td>";
                            echo "<td>" . $row['internal'] . "</td>";
                            echo "<td>" . $row['total'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";
                            echo "<td>" . $row['credits'] . "</td>";
                            echo "<td>" . $row['grade'] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table><br>";
                    } else {
                        echo "0 results";
                    }
                    $conn2->close();
                ?>
            </div>
            <div id="btns">
                <form action="edits.php" method="post">
                    <button class="edit" name="username" type="submit" value="<?php echo $username ?>">Edit</button>
                </form>
                <button class="back" onclick="window.location.href='adminhome.php?value=resultview.php'" >Back</button>
            </div>
        </div>
    </div>
</body>
</html>