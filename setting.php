<?php
session_start();

include_once 'db_connection.php';

if (isset($_SESSION['user-id'])) {
    $user_id = $_SESSION['user-id']; 

    $sql = "SELECT * FROM user
            WHERE `user-id` = {$_SESSION['user-id']}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();

    if (isset($_GET['user-name'])) {
        $username = $_GET['user-name'];
        header("Location: signout.php?user-name=".urlencode($username));
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Setting</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
	
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Inter", sans-serif}
</style>
</head>
<body class="w3-light-grey w3-content" style="max-width:1600px">

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-oxford-blue w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container">
    <a href="#" onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-grey" title="close menu">
      <i class="fa fa-remove"></i>
    </a>
    <img src="images/user/<?php echo $user['user-image']?>" style="width:250px;" class="w3-circle-white"><br><br>
    <h2><b>
      <?php echo $user['user-name']; ?>
    </b></h2>
    <p class="w3-text-light-grey"><h4>
    <?php echo $user['user-affiliation']; ?>
    </h4></p>
    <h3>#<?php echo $user['user-id']; ?></h3>
  </div>
  <div class="w3-bar-block p-t-15">
    <a href="project.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-th-large fa-fw w3-margin-right"></i>MY PROJECTS</a> 
    <a href="to-do.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-check-square fa-fw w3-margin-right"></i>TO-DO</a> 
    <a href="wordlist.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-list fa-fw w3-margin-right"></i>WORDLIST</a>
    <a href="instant.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-hourglass-half fa-fw w3-margin-right"></i>INSTANT WORD</a>
  </div>
  <div class="w3-bar-block p-t-15">
  <a href="setting.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-gear fa-fw w3-margin-right"></i><b>SETTING</b></a>
    <a href="signout.php?user-name=<?php echo urlencode($user['user-name']); ?>" onclick="w3_close()" class="w3-bar-item w3-button w3-padding">
        <i class="fa fa-sign-out fa-fw w3-margin-right"></i>LOG OUT
    </a>
</div>
  <!--<div class="w3-panel w3-large">
    <i class="fa fa-facebook-official w3-hover-opacity"></i>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-snapchat w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-linkedin w3-hover-opacity"></i>
  </div>-->
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px">

  <!-- Header -->
  <header id="setting">

    <!--<a href="#"><img src="/w3images/avatar_g2.jpg" style="width:65px;" class="w3-circle w3-right w3-margin w3-hide-large w3-hover-opacity"></a>-->
    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
    <div class="w3-container">
    <img src="images/logo-blue.png" style="height:100px;" class="w3-right w3-hide-small w3-hide-medium w3-animate-top" id="corner-logo">
    <h1 class="header-title p-t-45"><b>Setting</b></h1>
    <div class="w3-section w3-padding-8">
    </div>
  </header>
  
  <div class="w3-container w3-padding-large w3-pale-grey">
    <h3 id="user-info"><b>Account Infomation</b></h3>
    <form method="POST" id="update">
      <div class="w3-section">
        <label><h4>Name</h4></label>
        <input class="w3-input w3-border" type="text" id="user-name" name="user-name" placeholder="<?php echo $user['user-name']; ?>">
      </div>
      <div class="w3-section">
        <label><h4>Affiliation</h4></label>
        <input class="w3-input w3-border" type="text" id="user-affiliation" name="user-affiliation" placeholder="<?php echo $user['user-affiliation']; ?>">
      </div>
      <div class="w3-section">
        <label><h4>E-mail Address</h4></label>
        <input class="w3-input w3-border" type="text" id="user-email" name="user-email" placeholder="<?php echo $user['user-email']; ?>">
      </div>
      <div class="w3-section">
        <label><h4>Password</h4></label>
        <input class="w3-input w3-border" type="password" id="user-password" name="user-password" placeholder="Type your new password">
      </div>
      <div class="text-center sign-message sign-message-error" id="pass-error">
					</div>
      <button type="submit" class="w3-button w3-black w3-margin-bottom"><h5>Save the Update</h5></button>
    </form>
    <div class="w3-section">
    <h3 id="user-image-upload"><b>Profile Image</b></h3>
    <form action="user-image.php" method="POST" enctype="multipart/form-data">
        <input class="w3-input w3-border p-t-15" type="file" id="user-image" name="user-image" accept="image/jpg, image/jpeg, image/png">
        <label><h5>Only JPG, JPEG, and PNG are allowed.</h5></label><br>
        <input type="submit" name="submit" class="w3-button w3-black w3-margin-bottom" value=upload></input>
    </form>
    <div class="text-center sign-message sign-message-error">
      <?php if (!empty($_SESSION['statusMsg'])) {
        echo $_SESSION['statusMsg'];
        unset($_SESSION['statusMsg']);
        } ?>
					</div>
      <div class="text-center sign-message sign-message-green">
      <?php if (!empty($_SESSION['statusMsgGreen'])) {
        echo $_SESSION['statusMsgGreen'];
        unset($_SESSION['statusMsgGreen']);
        } ?>
					</div>
      </div>
  </div>
  <div class="w3-oxford-blue w3-center w3-padding-24" id="footer">
    <div class="w3-center">
      <img src="images/logo-cut.png" style="height:30px;">
    </div>
    <div class="w3-center">
      powered by <a href="acknowledgement.php" title="wanna see who did this!!" target="_blank" class="w3-hover-opacity"><b>LangTech students</b></a>
    </div>

<!-- End page content -->
</div>


<?php
if (isset($_POST['user-name']) && isset($_POST['user-affiliation']) && isset($_POST['user-email']) && isset($_POST['user-password'])) {
  $user_name = $_POST['user-name'];
  $user_affiliation = $_POST['user-affiliation'];
  $user_email = $_POST['user-email'];
  $user_password = password_hash($_POST['user-password'], PASSWORD_DEFAULT);

  $query = "UPDATE `user` SET";
  $fields = array();

  if (!empty($user_name)) {
      $fields[] = "`user-name` = '$user_name'";
  }

  if (!empty($user_affiliation)) {
      $fields[] = "`user-affiliation` = '$user_affiliation'";
  }

  if (!empty($user_email)) {
      $fields[] = "`user-email` = '$user_email'";
  }

  if (!empty($user_password)) {
      $fields[] = "`user-password-hash` = '$user_password'";
  }

  if (!empty($fields)) {
      $query .= " " . implode(", ", $fields);
      $query .= " WHERE `user-id` = '$user_id'";

      $result = $mysqli->query($query);

      if (!$result) {
          die("Database query failed: " . $mysqli->error);
      }
  }
}
?>


<script>
// Script to open and close sidebar
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}
</script>
<script>
// Validate the password
function validatePassword() {
  var passwordInput = document.getElementById("user-password");
  var password = passwordInput.value;

  var requirements = [
    { regex: /.{8,}/, message: "at least 8 characters long" },
    { regex: /[A-Z]/, message: "one uppercase letter" },
    { regex: /[a-z]/, message: "one lowercase letter" },
    { regex: /[0-9]/, message: "one numeric character" },
    { regex: /[!@#$%^&*(),.?":{}|<>_-]/, message: "one special character" }
  ];

  var errorMessage = document.querySelector('.sign-message-error');
  var errorMessages = [];

  if (password === "") {
    errorMessage.textContent = "";
    passwordInput.style.borderColor = "";
    enableSubmitButton(); // Enable the submit button when the password field is empty
    return;
  }

  for (var i = 0; i < requirements.length; i++) {
    if (!requirements[i].regex.test(password)) {
      errorMessages.push(requirements[i].message);
    }
  }

  if (errorMessages.length > 0) {
    var errorMessageText = "Password must include ";
    if (errorMessages.length === 1) {
      errorMessageText += errorMessages[0] + ".";
    } else {
      var lastRequirement = errorMessages.pop();
      errorMessageText += errorMessages.join(", ") + ", and " + lastRequirement + ".";
    }
    errorMessage.textContent = errorMessageText;
    passwordInput.style.borderColor = "red";
    disableSubmitButton(); // Disable the submit button when the password requirements are not met
  } else {
    errorMessage.textContent = "";
    passwordInput.style.borderColor = "";
    enableSubmitButton(); // Enable the submit button when the password requirements are met
  }
}

// Disable the submit button
function disableSubmitButton() {
  var submitButton = document.querySelector('button[type="submit"]');
  submitButton.disabled = true;
  submitButton.style.opacity = 0.5;
}

// Enable the submit button
function enableSubmitButton() {
  var submitButton = document.querySelector('button[type="submit"]');
  submitButton.disabled = false;
  submitButton.style.opacity = 1;
}

// Add event listener to trigger password validation
document.getElementById("user-password").addEventListener("input", validatePassword);
</script>

</body>
</html>