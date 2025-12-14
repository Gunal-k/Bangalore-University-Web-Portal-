<?php 
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/reset.css">
    <title>Reset Password - Bnagalore University</title>
</head>
<body>
    <div class="wrap"></div>
    <div class="wrapper" id="sec">
		<form action="login-register/forgot_pass.php" method="POST">
			<h1>Reset Password</h1>
			<div class="input-box">
				<input type="password" name="password1" placeholder="Old Password" required>
			</div>
			<div class="input-box">
				<input type="password" name="password2" placeholder="New Password" required>
			</div>
			<button type="submit" class="btn">Update</button>
			<p><a href="userhome.php" id="signIn" style="font-size: 15px; text-decoration: underline;">Back</a></p>
		</form>
  	</div>
</body>
</html>