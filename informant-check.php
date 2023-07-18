<?php
ob_start();
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

$projectID = $_GET['project_id'];

$wordlistID = $_GET['wordlist'];

?>

<!DOCTYPE html>
<html>
<head>
<title>Informant Data</title>
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
<style>
.button-height {
  height: 150px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 5px;
}


.w3-radio + label {
      font-size: 50px;
    }

.w3-height-custom {
  height: 40px;
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
  <header id="new-project">

    <!--<a href="#"><img src="/w3images/avatar_g2.jpg" style="width:65px;" class="w3-circle w3-right w3-margin w3-hide-large w3-hover-opacity"></a>-->
    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
    <div class="w3-container" style="text-align: center; padding-top: 20%">
    <h1 class="header-title p-t-45 p-b-45"><b>Informant Checking</b></h1>

    </div>

</header>
  <?php
    require_once 'db_connection2.php';

    $sql = "SELECT `entry-id` FROM `lexicon`.`entry` WHERE `wordlist-id` = {$wordlistID} LIMIT 1";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    $entryID = $row['entry-id'];

    if ($result && $result->num_rows > 0) {
        // Matching entry found, check if there is a matching pronunciation entry
        $sql = "SELECT `recorded-on`, `informant-id` FROM `lexicon`.`pronunciation` WHERE `entry-id` = {$entryID} ORDER BY `recorded-on` DESC LIMIT 1";
        $result = $mysqli->query($sql);
        $row = $result->fetch_assoc();

        if ($result && $result->num_rows > 0) {
            // Matching pronunciation entry found
            $informantID = $row['informant-id']; ?>

            <div class="w3-container w3-padding-large w3-royal-blue" style="text-align: center; margin: 0% 20%; border-radius: 10px">
            <h2 id="informant-info"><b>Is the same informant?</b></h2>
            <form method="POST" id="informant-form"> 
                <div style="display: inline-block; text-align: left;">
                <h3><input type="radio" class="w3-radio" name="new-ifm" value="yes" onchange="toggleWordlistName(this)" required/> Yes </h3>
                <h3><input type="radio" class="w3-radio" name="new-ifm" value="no" onchange="toggleWordlistName(this)" required/> No </h3>
                <br>
            </div>
            <div class="input-group w3-height-custom" id="informant-data-group" style="display: none;">
                <label style="display: inline-block; width: 35%;">
                    <h5><b>Informant Name:</b></h5>
                </label>
                <input type="text" class="w3-input" id="informant-name" name="informant-name" placeholder="Enter Informant Name"><br>
                <label style="display: inline-block; width: 35%;">
                    <h5><b>Informant's Sex:</b></h5>
                </label>
                <select name="sex" id="sex">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <br>
            <div class="w2-center">
                <input name="submit" type="submit" id="informant-submit" class="w3-button btn-outline-secondary w3-oxford-blue w3-margin-bottom" value="Start">
                </div>
            </form>
            </div>
            </div>            

    <?php    } else { ;?>
            <!--No matching pronunciation entry found-->
            <div class="w3-container w3-padding-large w3-royal-blue" style="text-align: center; margin: 0% 20%; border-radius: 10px">
            <h2><b>Let's start collecting data!</b></h2>
                <form method="POST" id="informant-form">
                <div>
                <label style="display: inline-block; width: 35%;">
                    <h5><b>Informant Name:</b></h5>
                </label>
                <input type="text" class="w3-input" id="informant-name" name="informant-name" placeholder="Enter Informant Name">
                <br>
                <label style="display: inline-block; width: 35%;">
                    <h5><b>Informant's Sex:</b></h5>
                </label>
                <select name="sex" id="sex">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                </div><br>
                <div class="w2-center">
                    <input name="submit" type="submit" id="informant-submit" class="w3-button btn-outline-secondary w3-oxford-blue w3-margin-bottom" value="Start">
                </div>
                </form>
                </div>
        </div>

    <?php    }
    } else {
        // No matching entry found
        echo '<div>No matching entry found.</div>';
    }
    ?>


<?php
require_once 'db_connection2.php';

if (isset($_POST['submit'])) {
    if (!empty($_POST['informant-name']) && isset($_POST['sex'])) {
    $informantName = $_POST['informant-name'];
    $informantSex = $_POST['sex'];
    $projectID = $_GET['project_id'];
    $wordlistID = $_GET['wordlist'];

    $stmt = $mysqli->prepare("INSERT INTO informant (`informant-name`, `informant-sex`) VALUES (?, ?)");
    $stmt->bind_param("ss",
                        $informantName, 
                        $informantSex);
    $stmt->execute();
    $sql = "SELECT `informant-id` FROM `lexicon`.`informant` WHERE `informant-name` = '{$informantName}' AND `informant-sex` = '{$informantSex}'";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    $informantID = $row['informant-id'];

    if ($informantID) {
        header("Location: collection.php?project_id={$projectID}&wordlist_id={$wordlistID}&informant_id={$informantID}");
        ob_end_flush();
    } else {
        echo "Error: " . $mysqli->error;
    }
    }

    else {
      header("Location: collection.php?project_id={$projectID}&wordlist_id={$wordlistID}&informant_id={$informantID}");
      ob_end_flush();
    }
}


?>
      
  
  
  <div class="w3-oxford-blue w3-center w3-padding-24" id="footer">
    <div class="w3-center">
      <img src="images/logo-cut.png" style="height:30px;">
    </div>
    <div class="w3-center">
      powered by <a href="acknowledgement.php" title="wanna see who did this!!" target="_blank" class="w3-hover-opacity"><b>LangTech students</b></a>
    </div>

<!-- End page content -->
</div>

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

function toggleWordlistName(radio) {
    var wordlistNameGroup = $("#informant-data-group");
    if (radio.value === "yes") {
      wordlistNameGroup.fadeOut(); // Fade out the input field
    } else {
      wordlistNameGroup.fadeIn(); // Fade in the input field
    }
  }
</script>

<!--===============================================================================================-->
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<!--===============================================================================================-->

</body>
</html>
