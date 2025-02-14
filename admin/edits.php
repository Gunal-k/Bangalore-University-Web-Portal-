<?php
    session_start();
    include "../login-register/database/db.php";
    $username=$_POST['username'];
    $sql = "SELECT * FROM $username";
    $result = $conn2->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/cards.css">
    <title>Results - Bangalore University</title>
    <style>
        table{
            margin-top: 40px;
            width: 125%;
        }
        input{
            width: 100%;
        }
        .val input{
            width: 50%;
        }
        .val{
            width:60px
        }
        #btns{
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: -5px;
            margin-right: 20px;
        }
        .edit{
            border:none;
            padding: 12px;
            width: 100%;
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
        form{
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="cards">
        <div class="card1">
            <div class="s1 card">
                <h1>EDIT</h1>
            </div>
            <div class="r2 card">
                <form action="../login-register/update.php" method="post">
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
                                    <th>Grade</th>
                                </tr>";
                            
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr class='row-" . $row['sno'] . "'>";
                                echo "<td>" . $row['sno'] . "</td>";
                                echo "<td><input type='text' name='subject[]' value='" . $row['subject'] . "' required></td>";
                                echo "<td><input type='number' name='max[]' class='val' value='" . $row['max'] . "' required></td>";
                                echo "<td><input type='number' name='min[]' class='val' value='" . $row['min'] . "' required></td>";
                                echo "<td><input type='number' name='scored[]' class='val' value='" . $row['scored'] . "' required></td>";
                                echo "<td><input type='number' name='internal[]' class='val' value='" . $row['internal'] . "' required></td>";
                                echo "<td><input type='number' name='total[]' class='val' value='" . $row['total'] . "' required></td>";
                                echo "<td><select name='status[]' required>
                                        <option value='Pass' " . ($row['status'] == 'Pass' ? 'selected' : '') . ">Pass</option>
                                        <option value='Fail' " . ($row['status'] == 'Fail' ? 'selected' : '') . ">Fail</option>
                                    </select></td>";
                                echo "<td><input type='number' name='credits[]' class='val' value='" . $row['credits'] . "' required></td>";
                                echo "<td><input type='text' name='grade[]' class='val' value='" . $row['grade'] . "' required></td>";
                                echo "</tr>";
                            }
                            echo "</table><br>";
                        } else {
                            echo "0 results";
                        }
                        $conn2->close();
                    ?>
                    <div id="btns">
                        <button class="edit" name="username" type="submit" value="<?php echo $username ?>">Update</button>
                        <button class="back" type="button" onclick="window.location.href='adminhome.php?value=results.php&username=<?php echo $username?>'" >Back</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>