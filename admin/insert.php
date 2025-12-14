<html>
<head>
    <title>User Insert</title>
</head>
<style>
th, td {
    padding: 15px;
    text-align: left;
  }
  input{
    padding: 5px;
    width: 100%;
  }
</style>
<body>
    <br><br>
    <center>
        <h2>Insert Data into User Table</h2>
        <form action="../login-register/register.php?value=1" method="post" enctype="multipart/form-data">
            <table border="1">
                <td><label>Email:</label></td>
                <td><input type="text" name="email" required></td>
                <tr>
                <td><label>Username:</label></td>
                <td><input type="text" name="username" required></td>
                </tr>
                <tr>
                <td><label>Enter Password:</label></td>
                <td><input type="password" name="password1" required></td>
                </tr>
                <tr>
                <td><label>Confirm Password:</label></td>
                <td><input type="password" name="password2" required></td>
                </tr>
                <tr>
                <td><label>Phone:</label></td>
                <td><input type="number" name="phone" required></td>
                </tr>
                <tr>
                    <td><label for="photo">Profile Image:</label></td>
                    <td><input type="file" name="photo" accept="image/jpg,image/jpeg,image/png" id="pp"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <center><input type="submit" value="register"></center>
                    </td>
                </tr>
            </table>
        </form>
    </center>
</body>
</html>
