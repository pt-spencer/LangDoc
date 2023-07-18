<?php

$password_hash = password_hash($_POST['user-password'], PASSWORD_DEFAULT);

require __DIR__ . "/db_connection.php";

$email = $_POST['user-email'];

// Check if the email already exists in the database
$checkEmailSql = "SELECT COUNT(*) FROM user WHERE `user-email` = ?";
$stmt = $mysqli->prepare($checkEmailSql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();

if ($count > 0) {
    // Redirect to a page indicating duplicate email
    header("Location: duplicate-email.php?user-email=". urlencode($_POST['user-email']));
    exit();
}

$sql = "INSERT INTO user (`user-name`, `user-affiliation`, `user-email`, `user-password-hash`) 
        VALUES (?, ?, ?, ?)";

$stmt = $mysqli->stmt_init();

if (!$stmt->prepare($sql)) {
    die("SQL ERROR! Failed to prepare statement: " . $stmt->error);
}

$stmt->bind_param("ssss", 
                  $_POST['user-name'], 
                  $_POST['user-affiliation'], 
                  $_POST['user-email'], 
                  $password_hash);

if (!$stmt->execute()) {
    die("SQL ERROR! Failed to execute statement: " . $insertStmt->error);
}
$stmt->close();
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Redirecting...</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    .container-login100 {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      position: relative; /* Add this line to make the container relative */
    }
    
    .logo-overlay {
      position: absolute;
      bottom: 20px; /* Adjust the value as needed */
      left: 50%;
      transform: translateX(-50%);
    }
    
    .logo-image-blue {
      max-width: 50%;
      max-width: min(80%, 1000px);
      height: 75px;
    }

    .name-text {
      font-size: 4rem;
      color: #002147;
    }
  </style>
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
<!--===============================================================================================-->
	
</head>
<body>

<div class="limiter">
	  <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-180 p-b-54 m-b-">
			<center>	
                <h1>Hi!<br>
                    <span class='name-text'><b>
                
                    <?php   $userFullName = $_POST['user-name'];
                            $firstName = preg_replace('/\s+.*$/', '', $userFullName); 
                            echo "$firstName" 
                    ?>
                            </b></h1> 
                    </span><br>
                    <br>
            <h2>
				Thank you for joining </h2>
                <img class="logo-image-blue" src="images/logo-wb.png" alt="Logo-col" />
                <br>
                <br>
                <h3> You will be redirected to the login page at the moment. </h3>
            </center>
			</div>
		</div>
	</div>

<?php
header("refresh:8;url=index.php");
?>


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
	<script src="js/auth.js"></script> -->
	<script src="js/main.js"></script>

</body>
</html>