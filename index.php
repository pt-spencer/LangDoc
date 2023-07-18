<?php

session_start();

// Check if the user is already authenticated
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated']) {
    header("Location: project.php");
    exit;
}

$is_valid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mysqli = require __DIR__ . '/db_connection.php';

	$sql = sprintf("SELECT * FROM user 
					WHERE `user-email` = '%s'",
					$mysqli->real_escape_string($_POST['username']));


    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();

    if ($user) {
		if (password_verify($_POST['password'], $user['user-password-hash'])) {
			session_start();

			session_regenerate_id();

			$_SESSION['user-id'] = $user["user-id"];
			$_SESSION['authenticated'] = true;

			header("Location: project.php");
			exit;
		}
	}

	$is_valid = true;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>LangDoc: A Preliminary Project</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" href="css/w3.css">
<!--===============================================================================================-->
	
</head>
<body>
	
	<div class="limiter">
	  <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54 w3-animate-left">
				
				<form method="post" class="login100-form validate-form" id="login">
					<span class="login100-form-title p-b-49">
					Login to Doc </span>

					<div class="wrap-input100 validate-input m-b-23" data-validate = "Username is required">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="username" 
							value="<?= htmlspecialchars($_POST["username"] ?? "") ?>" id="username" placeholder="Type your email address">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="password" id="password" placeholder="Type your password">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
				
					
					<div class="text-right p-t-8">
						<a href="#">
							Forgot password?
						</a>
					</div>

					<div class="text-center p-t-8 p-b-20 log-message log-message-error">
						<?php if ($is_valid): ?>
							Invalid username and/or password
						<?php endif; ?>
					</div>
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Login
							</button>
						</div>
					</div>

					<div class="txt1 text-center p-t-30 p-b-20">
						<span>
							Or Sign In Using
					  </span>
					</div>

					<div class="flex-c-m">
						<a href="https://orcid.org/signin" class="login100-social-item bg2"><b>iD</b></a>
						
						<a href="https://www.facebook.com/login" class="login100-social-item bg1">
							<i class="fa fa-facebook"></i>
						</a>

						<a href="https://accounts.google.com" class="login100-social-item bg3">
							<i class="fa fa-google"></i>
						</a>

					</div>

					<div class="flex-col-c p-t-45">
						<span class="txt1 p-b-17">
							New to LangDoc?
							<a href="#" class="txt2" id="linkSignUp">
							<b>Sign Up</b>
						 	</a>
						</span>
					</div>
				</form>
				
				<form action="signup.php" method="post"class="login100-form validate-form form-hidden" id="SignUp">
					<span class="login100-form-title p-b-35">
					Create an Account </span>

					<div class="wrap-input100 m-b-20" data-validate = "Your name is required">
						<span class="label-input100">Name</span>
						<input class="input100" id="user-name" type="text" name="user-name" placeholder="Type your name and surname">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 m-b-20" data-validate = "Affiliation is required">
						<span class="label-input100">Affiliation</span>
						<input class="input100" id="user-affiliation" type="text" name="user-affiliation" placeholder="Type your affiliation">
						<span class="focus-input100" data-symbol="&#xf174;"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-20" data-validate = "Email is required">
						<span class="label-input100">Email Address</span>
						<input class="input100" id="user-email" type="text" name="user-email" placeholder="Type your email address">
						<span class="focus-input100" data-symbol="&#xf15a;"></span>
					</div>
					
					<div class="text-center user-message user-message-error" id="mail-error">
					</div>

					<div class="wrap-input100 validate-input m-b-20" data-validate="Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" id="user-password" type="password" name="user-password" placeholder="Type your password">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
					
					<div class="text-center sign-message sign-message-error" id="pass-error">
					</div>
					
					<!--
					<div class="wrap-input100 validate-input m-b-20" data-validate="Passwords do not match">
						<span class="label-input100">Comfirm Your Password</span>
						<input class="input100" type="password" name="confirmPass" placeholder="Type your password again">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
				-->
				
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" id="signup-btn">
								Sign Up
							</button>
						</div>
					</div>

				

					<div class="flex-col-c p-t-20">
						<span class="txt1 p-b-17">
							Already in LangDoc?
							<a href="#" class="txt2" id="linkLogin">
							<b>Sign In</b>
						 	</a>
						</span>
					</div>
				</form>
				
			</div>
		</div>
		<div class="logo-overlay"> 
			<img class="logo-image w3-animate-right" src="images/logo.png" alt="Logo" />
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<!--<script src="index.js"></script>
	<script src="js/auth.js"></script>-->
	<script src="js/main.js"></script>

</body>
</html>