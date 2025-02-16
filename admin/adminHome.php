<?php
session_start();
$message = $_SESSION['message'] ?? "";
$site = $_GET['value'] ?? "home.php";
unset($_SESSION["message"]);

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: ../login.php");
    exit();
}
if (isset($_SESSION['message'])) {
    echo "<script>alert('{$_SESSION['message']}');</script>";
    unset($_SESSION['message']); 
}

if (isset($_GET["logout"])) {
    session_unset();
    session_destroy();
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/admin.css">
    <link rel="icon" href="../assets/kn_seal.png" type="image/x-icon">
    <title>Admin - Bangalore University</title>
    <script>
        function loadPage(page) {
            const contentDiv = document.getElementById('content');
            fetch(page + '.php')
                .then(response => {
                    if (!response.ok) throw new Error('Page not found');
                    return response.text();
                })
                .then(html => {
                    contentDiv.innerHTML = html;
                })
                .catch(error => {
                    console.error('Error loading page:', error);
                    window.location.href = 'login.php';
                });
        }
    </script>
</head>
<body>
<header>
    <span id="main">
        <img src="../assets/education (1).png" alt="Bangalore University" class="logo">
        <h2>Bangalore University Database</h2>
    </span>
    <div class="head">
        <button onclick="loadPage('home')">Home</button>
        <!--<button onclick="loadPage('insert')">Add User</button>-->
        <button onclick="loadPage('cards')">Registered Users</button>
        <button onclick="loadPage('resultview')">View Results</button>
        <form action="adminHome.php?logout=1" method="POST" onsubmit="return confirm('Are you sure you want to log out?');">
            <button type="submit" class="login">Logout</button>
        </form>

    </div>
</header>
<div id="content">
    <?php
    include 'home.php';
    ?>
</div>
</body>
</html>
