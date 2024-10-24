<?php
	session_start();
	$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
	unset($_SESSION["message"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/kn_seal.png" type="image/x-icon">
    <link rel="stylesheet" href="styles/login.css">
    <title>Sign in - Bangalore University</title>
</head>
<body>
	<div class="wrap"></div>
	<div class="container" id="main">
		<div class="register">
			<form action="login-register/register.php" method="post">
				<h1>Create Account</h1><br>
				<input type="email" name="email" id="" placeholder="Email Id" required>
				<input type="text" name="username" placeholder="Username" required>
				<input type="password" name="password" placeholder="Password" required>
				<p>Have account ? <a href="" id="signIn">Sign in</a></p>
				<button type="submit" value="register">Register</button>
			</form>
		</div>
		<div class="sign-in">
			<form action="login-register/loginver.php" method="post">
				<h1>Sign in</h1><br>
				<input type="text" name="username" placeholder="Username" required>
				<input type="password" name="password" placeholder="Password" required>
				<p><a href="" id="fp" onclick="reveal()">Forgot Password</a> / <a href="" id="register">Register</a></p>
				<button type="submit">Sign In</button>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-left">
					<h1>Welcome to </h1>
                    <h1 style="width: 400px;">Bangalore University</h1>
					<p>Register and Start your journey with us</p>
				</div>
				<div class="overlay-right">
					<h1>Welcome Back!</h1>
					<p>To keep connected with us, Please login</p>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		const signUpButton = document.getElementById('register');
		const signInButton = document.getElementById('signIn');
		const main = document.getElementById('main');

		if ("<?php echo addslashes($message); ?>" !== "") {
			alert("<?php echo addslashes($message); ?>");
			if ("<?php echo addslashes($message); ?>"=="Name is already taken"){
				main.classList.add("right-panel-active");
			}
		}

		signUpButton.addEventListener('click', () => {
			event.preventDefault();
			main.classList.add("right-panel-active");
		});
		signInButton.addEventListener('click', () => {
			event.preventDefault();
			main.classList.remove("right-panel-active");
		});
	</script>
</body>
</html>