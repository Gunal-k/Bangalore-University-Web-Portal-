<?php
    session_start();
    include "login-register/database/db.php";
    $id=$_SESSION['username'];
    $stmt = $conn1->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $img=$row['photo'];
?>
<html>
<head>
    <title>Profile - Bangalore Universty</title>
</head>
<style>
    *{
        font-size: 1.1rem;
        font-family: Arial, Helvetica, sans-serif;
    }
    body{
        background-color: #F6F8FB;
    }
    h1{
        font-size: 40px;
    }

    table{
        background:white;
        width: 80%;
        height:300px;
        border-collapse: collapse;
    }
    th, td {
        padding: 15px;
        text-align: left;
    }
    .btns input{
        border: none;
        padding: 10px;
        border-radius: 50px;
        margin: 10px;
        cursor: pointer;
    }
    #cancel{
        background-color: red;
        color: white;
    }
    #img_pro{
        height: 150px;
        width: 150px;
        object-fit: cover;
        border-radius: 5px;
    }
    #update{
        border: 1px solid #8F1717;
    }
    footer{
        display: none;
    }
    .t1{
        border:1px solid black;
        border-radius: 5px;
    }
    .t2{
        border:1px solid black;
        border-radius: 10px;
    }
    .tab1{
        margin-top: 100px;
    }
    .tab2{
        height:50%;
        width: 90%;
    }
    .back_button{
        border-radius: 50px;
        margin-top: 10px;
        padding: 10px;
        cursor: pointer;
        border: 2px solid #8F1717;
        color: #8F1717;
        background-color: #fff;
    }
</style>
<body>
    <center>
        <table class="tab1">
            <tr class="t1">
                <td colspan="3">Your Profile</td>
            </tr>
            <tr class="t2">
                <td rowspan="4">
                    <center><img src="login-register/uploads/<?php echo $img ?>" alt="" id="img_pro"></center>
                </td>
                <td>
                    <center>
                        <table border="1" class="tab2">
                            <tr>
                                <td>
                                    <label>Email:</label>
                                </td>
                                <td>
                                    <?php echo $row['email'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Username:</label>
                                </td>
                                <td>
                                    <?php echo $row['username'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Phone:</label>
                                </td>
                                <td>
                                    <?php echo $row['phone'] ?>
                                </td>
                            </tr>
                        </table>
                    </center>
                </td>
            </tr>
        </table>
        <button onclick="loadPage('Home.html')" class="back_button">Back to Home</button>
    </center>
</body>
</html>