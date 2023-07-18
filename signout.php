<?php

session_start();

session_destroy();

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
			<div class="wrap-login100 p-l-55 p-r-55 p-t-180 p-b-54">
			<center>	
                <h1>See you soon!<br>
                    <span class="name-text"><b>
                
                    <?php   $userFullName = $_GET['user-name'];
                            $firstName = preg_replace('/\s+.*$/', '', $userFullName); 
                            echo "$firstName" 
                    ?>
                            </b></h1> 
                    </span>
            <h2 class="p-t-25">
				      You have been logged out
            </h2>
            </center>
            <div class="p-t-150">
            <center>
            <img class="logo-image-blue" src="images/icons/favicon.ico" alt="Logo-ico" style="display: inline-block; vertical-align: middle;" />
            <h4 class="w3-display-inline" style="display: inline-block; vertical-align: middle;"><b>&nbsp;by LangTech Chula</b></h4>
            </center>
          </div>

			</div>
		</div>
	</div>

<?php
header("refresh:5;url=index.php");
exit;
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