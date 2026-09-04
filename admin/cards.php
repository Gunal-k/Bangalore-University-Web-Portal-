<?php
include("../login-register/database/db.php");
if ($conn->connect_error) {
    die("Connection failed: {$conn->connect_error}");
}

$sql = "SELECT * FROM users where role='student'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/cards.css">
    <title>Users</title>
</head>
<body>
    <div class="cards">
        <div class="card1">
            <div class="s1 card">
                <h1>Registered Users</h1>
            </div>
            <center>
                <hr>
            </center>
            <div class="r2 card">
                <?php
                    if ($result->num_rows > 0) {
                        echo "<table>";
                        echo "<tr><th>User ID</th><th>Email</th><th>Username</th><th>phone</th><th>Photo</th><th>Operations</th></tr>";
                        while ($row = $result->fetch_assoc()) {
                            $id = $row['user_id'];
                            echo "<tr class='$id'>";
                            echo "<td>" . $row['user_id'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['username'] . "</td>";
                            // echo "<td>" . $row['role'] . "</td>";
                            echo "<td>" . $row['phone'] . "</td>";
                            echo "<td><center><img src='{$row['photo']}' alt='profile_img' style='object-fit: cover;'></center></td>";
                            echo "<td class='buttons'>
                                
                                <form action='../login-register/delete.php' method='post'>
                                    <input type='hidden' name='username' value='".$row['username']."'>
                                    <input type='hidden' name='user_id' value='".$row['user_id']."'>
                                    <button type='submit' id='delete' onclick='confirmDelete(this)' value='delete'>DELETE</button>
                                </form>
                                </td>";
                        }
                        echo "</table>";
                    } else {
                        echo "0 results";
                    }
                    $conn->close();
                ?>
            </div>
        </div>
    </div>   
    <script>
        function confirmDelete(a) {
            const val=confirm('Are you sure you want to Delete this User?');
            if(val){
                const elem = a.closest('form');
                elem.submit();
            }
        }
    </script>
</body>
</html>
