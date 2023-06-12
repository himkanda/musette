<?php
	include("includes/config.php");
	include("includes/classes/Account.php");
	include("includes/classes/Constants.php");

	$account = new Account($con);

	include("includes/handlers/register-handler.php");
	include("includes/handlers/login-handler.php");

	function getInputValue($name) {
		if(isset($_POST[$name])) {
			echo $_POST[$name];
		}
	}
?>
<script> 
    var page_title = "Musette";
    document.title= page_title;
</script>
<html>
<head>
	<title></title>
	<link rel="icon" type="image/gif/png" href="assets/images/icons/groove.png" sizes="30x30">

	<link rel="stylesheet" type="text/css" href="assets/css/register.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="assets/js/register.js"></script>
</head>
<body>
	<?php

	if(isset($_POST['registerButton'])) {
		echo '<script>
				$(document).ready(function() {
					$("#loginForm").hide();
					$("#registerForm").show();
				});
			</script>';
	}
	else {
		echo '<script>
				$(document).ready(function() {
					$("#loginForm").show();
					$("#registerForm").hide();
				});
			</script>';
	}

	?>
	

	<div id="background">
		<div id="logo">
			<a href="http://localhost/Musette/"><img src="assets/images/icons/groove.png" alt=""></a>
		</div>
		<div id="loginContainer">
			
			<div id="inputContainer">
				<form id="loginForm" action="register.php" method="POST">
					<h2>Login to your account</h2>
					<p>
						<?php echo $account->getError(Constants::$loginFailed); ?>
						<label for="loginUsername">Username</label>
						<input id="loginUsername" name="loginUsername" type="text" placeholder="e.g. XYZ" value="<?php getInputValue('loginUsername') ?>" required autocomplete="off">
					</p>
					<p>
						<label for="loginPassword">Password</label>
						<input id="loginPassword" name="loginPassword" type="password" placeholder="Your password" required>
					</p>

					<button type="submit" name="loginButton">LOG IN</button>

					<div class="hasAccountText">
						<span id="hideLogin" role='link'>Don't have an account yet? Signup here.</span>
					</div>
					
				</form>



				<form id="registerForm" action="register.php" method="POST">
					<h2>Create your free account</h2>
					<p>
						<?php echo $account->getError(Constants::$usernameCharacters); ?>
						<?php echo $account->getError(Constants::$usernameTaken); ?>
						
						<input id="username" name="username" type="text" placeholder="Username" value="<?php getInputValue('username') ?>" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$firstNameCharacters); ?>
						
						<input id="firstName" name="firstName" type="text" placeholder="First name" value="<?php getInputValue('firstName') ?>" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$lastNameCharacters); ?>
						
						<input id="lastName" name="lastName" type="text" placeholder="Last name" value="<?php getInputValue('lastName') ?>" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
						<?php echo $account->getError(Constants::$emailInvalid); ?>
						<?php echo $account->getError(Constants::$emailTaken); ?>
						
						<input id="email" name="email" type="email" placeholder="Your email" value="<?php getInputValue('email') ?>" required>
					</p>

					<p>
						
						<input id="email2" name="email2" type="email" placeholder="Confirm email" value="<?php getInputValue('email2') ?>" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$passwordsDoNoMatch); ?>
						<?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
						<?php echo $account->getError(Constants::$passwordCharacters); ?>
						
						<input id="password" name="password" type="password" placeholder="Password" required>
					</p>

					<p>
						
						<input id="password2" name="password2" type="password" placeholder="Confirm Password" required>
					</p>
					<p>
						<h6>By clicking on Sign up, you agree to Slotify's Terms and Conditions of Use. </h6> 
					</p>

					<button type="submit" name="registerButton">SIGN UP</button>

					<div class="hasAccountText">
						<span id="hideRegister" role="link">Already have an account? Log in here.</span>
					</div>
					
				</form>


			</div>

			<div id="loginText">
				<h1>Get great music, right now</h1>
				<h2>Listen to millions of songs for free</h2>
				<ul>
					<li>Discover handcurated music</li>
					<li>Create your playlists</li>
					<li>Follow hot artists </li>
				</ul>
			</div>

		</div>
	</div>

</body>
</html>