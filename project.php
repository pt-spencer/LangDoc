<?php
session_start();
include 'auth.php';

if (isset($_SESSION['user-id'])) {
    $mysqli = require __DIR__ . '/db_connection.php';

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

if (isset($_GET['message'])) {
    $message = $_GET['message'];
    echo "<script>alert('$message');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>My Projects</title>
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
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Inter", sans-serif}
</style>
<style>
.button-height {
  height: 150px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 5px;
}

.button-item {
  height: 150px;
  align-items: center;
  text-align: left;
  justify-content: center;
  border-radius: 5px;
}

.button-content {
  display: flex;
  justify-content: space-between;
}

.left-content {
  flex-basis: 70%;
  text-align: left;
}

.right-content {
  flex-basis: 30%;
  text-align: right;
}
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
    <a href="project.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i><b>MY PROJECTS</b></a> 
    <a href="to-do.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-check-square fa-fw w3-margin-right"></i>TO-DO</a> 
    <a href="wordlist.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-list fa-fw w3-margin-right"></i>WORDLIST</a>
    <a href="instant.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-hourglass-half fa-fw w3-margin-right"></i>INSTANT WORD</a>
  </div>
  <div class="w3-bar-block p-t-15">
  <a href="setting.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-gear fa-fw w3-margin-right"></i>SETTING</a>
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
  <header id="projects">

    <!--<a href="#"><img src="/w3images/avatar_g2.jpg" style="width:65px;" class="w3-circle w3-right w3-margin w3-hide-large w3-hover-opacity"></a>-->
    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
    <div class="w3-container">
    <img src="images/logo-blue.png" style="height:100px;" class="w3-right w3-hide-small w3-hide-medium w3-animate-top">
    <h1 class="header-title p-t-45 p-b-45"><b>My Projects</b></h1>

    </div>
  </header>

<div class="w3-row-padding" style="margin:0 16px">

  <div class="w3-row-padding">

    <?php
// Fetch all projects belonging to the current user
$sqlAssignment = "SELECT * FROM `project-assignment` WHERE `user-id` = {$_SESSION['user-id']}";
$resultAssignment = $mysqli->query($sqlAssignment);

// Array of available colors
$colors = array(
  '#F5D7DC', '#F2B5D4', '#F7E3D7', '#F9CFCF', '#FDEDEC',
  '#D4EFDF', '#D1F2EB', '#D6EAF8', '#D6DBDF', '#EAF2F8',
  '#F9E79F', '#F4D03F', '#FCF3CF', '#F8C471', '#FDEBD0',
  '#D2B4DE', '#C39BD3', '#D6EAF8', '#D5D8DC', '#EBDEF0',
  '#ABEBC6', '#A2D9CE', '#AED6F1', '#A9CCE3', '#E8DAEF'
);


// Loop through each project and display it
while ($projectAssignment = $resultAssignment->fetch_assoc()) {
    $projectID = $projectAssignment['project-id'];
    $sqlProject = "SELECT * FROM `project` WHERE `project-no` = $projectID";
    $resultProject = $mysqli->query($sqlProject);
    $project = $resultProject->fetch_assoc();

    $languageID = $project['language-id'];

    $sqlLanguage = "SELECT `language-name` FROM `language` WHERE `language-id` = '$languageID'";
    $resultLanguage = $mysqli->query($sqlLanguage);
    $language = $resultLanguage->fetch_assoc();

    // Generate a random index to pick a color from the array
    $randomColorIndex = array_rand($colors);
    $randomColor = $colors[$randomColorIndex];

    // Remove the selected color from the array to avoid duplication
    unset($colors[$randomColorIndex]);

    echo '<div class="w3-margin-bottom">';
    echo '<a href="project-home.php?project_id=' . $project['project-no'] . '">';
    echo '<button class="w3-button w3-block w3-xlarge button-item" style="background-color: ' . $randomColor . ';">';
    echo '<div class="button-content">';
    echo '<div class="left-content">';
    echo '<h4 class="w3-text-dark-grey">' . $project['project-no'] . '</h4>';
    echo '<h1 class="w3-text-dark-grey"><b>' . $project['project-name'] . '</b></h1>';
    echo '<h4 class="w3-text-dark-grey"><i>' . $project['project-affiliation'] . '</i></h4>';
    echo '</div>';
    echo '<div class="right-content">';
    echo '<h4 class="w3-text-dark-grey" style="float: right; bottom: 0px;">Language: <b>' . $language['language-name'] . '</b></h4>';
    echo '</div>';
    echo '</div>';
    echo '</button>';
    echo '</a>';
    echo '</div>';
}

?>
  </div>

  <div class="w3-half w3-margin-bottom">
    <button onclick="location.href='create-project.php';" type="button" class="w3-button w3-button-dark w3-block w3-beige w3-xlarge w3-padding-32 button-height"><b>CREATE NEW PROJECT</b></button>
  </div>
  <div class="w3-half w3-margin-bottom">
    <button id="contribute-button" class="w3-button w3-block w3-royal-blue w3-xlarge w3-padding-32 button-height"><b>CONTRIBUTE TO<br>THE EXISTING PROJECT</b></button>
  <div class="w3-container w3-padding-large w3-pale-grey" id="existing-group" style="display: none;">
    <form action="join-project.php" method="POST">
      <div class="w3-section">
        <label><b>Project Code</b></label>
        <input class="w3-input w3-border" type="text" name="project-code" id="project-code" placeholder="Enter the code you received" required>
      </div>
      <button type="submit" name="submit" class="w3-button w3-black w3-margin-bottom"><i class="fa fa-paper-plane w3-margin-right"></i>Join the Group</button>
    </form>
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



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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

$(document).ready(function() {
  $('#contribute-button').click(function() {
    $('#existing-group').slideToggle();
  });
});
</script>



</body>
</html>
