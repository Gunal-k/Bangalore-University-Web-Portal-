<?php
	session_start();
	$message = $_SESSION['message'] ?? '';
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
	<center>
		<div class="container" id="main">
			<div class="register">
				<form action="login-register/register.php" method="post" enctype="multipart/form-data">
					<h1>Create Account</h1><br>
					<input type="email" name="email" id="" placeholder="Email Id" required>
					<input type="text" name="username" placeholder="Username" required>
					<input type="number" name="phone" placeholder="Phone" min="1111111111" max="9999999999" value="" required>
					<input type="password" name="password1" placeholder="Enter Password" required>
					<input type="password" name="password2" placeholder="Confirm Password" required>
					<input type="file" name="photo" accept="image/jpg,image/jpeg,image/png" id="pp">
					<label for="pp" class="file-label default">Select an image</label>
					<p>Have account ? <a href="" id="signIn">Sign in</a></p>
					<button type="submit" value="register">Register</button>
				</form>
			</div>
			<div class="sign-in">
				<form action="login-register/loginver.php" method="post">
					<h1>Sign in</h1><br>
					<input type="text" name="email" placeholder="Email Id" required>
					<input type="password" name="password" placeholder="Password" required>
					<p><a href="forgot.html" id="fp">Forgot Password</a> / <a href="" id="register">Register</a></p>
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
	</center>
	<script type="text/javascript">
		const signUpButton = document.getElementById('register');
		const signInButton = document.getElementById('signIn');
		const main = document.getElementById('main');

		document.getElementById('pp').addEventListener('change', function() {
			const label = document.querySelector('.file-label');

			if (this.files.length > 0) {
				this.style.border="4px solid brown";
				label.classList.remove('default');
				label.style.border="2px solid #8F1717";
				label.classList.add('uploaded');
				label.innerHTML="File Uploded";
			} else {
				label.classList.remove('uploaded');
				label.classList.add('default');
			}
    	});


		if ("<?php echo addslashes($message); ?>" !== "") {
			alert("<?php echo addslashes($message); ?>");
			if ("<?php echo addslashes($message); ?>"=="Email is already taken"){
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