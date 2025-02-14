<?php
include "..\login-register\database\db.php";
if ($conn1->connect_error) {
    die("Connection failed: {$conn1->connect_error}");
}

$sql = "SELECT * FROM users where role='user'";
$result = $conn1->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/adres.css">
    <title>Document</title>
</head>
<body>
    <div class="cards">
        <div class="card1">
            <div class="s1 card">
                <h1>View Results</h1>
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
                            echo "<td><center><img src='../login-register/uploads/".$row['photo']."' alt='profile_img' style='object-fit: cover;'></center></td>";
                            echo "<td class='buttons'>
                                
                                <form action='results.php' method='post'>
                                    <input type='hidden' name='username' value='".$row['username']."'>
                                    <button type='submit' id='delete' value='delete'>View</button>
                                </form>
                                </td>";
                        }
                        echo "</table>";
                    } else {
                        echo "0 results";
                    }
                    $conn1->close();
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