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

$projectId = $_GET['project_id']

?>

<!DOCTYPE html>
<html>
<head>
<title>Create New Project</title>
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
    <div class="w3-container">
    <img src="images/logo-blue.png" style="height:100px;" class="w3-right w3-hide-small w3-hide-medium w3-animate-top">
    <h1 class="header-title p-t-45 p-b-45"><b>Create New Project</b></h1>

    </div>
  </header>

  <div class="w3-container w3-padding-large w3-pale-grey" style="text-align: center;">
  <h3 id="user-info"><b>Wordlist Preference</b></h3>
  <h6>By choosing the list, the words, together with their part of speech and definition, will be automatically added to your project, saving your time from manually adding them. You can update and modify the list later</h6>
  <form action="wl-insert.php?project_id=<?= $projectId ?>" method="POST" id="wordlist-form">
    <div style="display: inline-block; text-align: left;">
    <input type="radio" class="w3-radio" name="wordlist" value="sw100" onchange="toggleWordlistName(this)"/> Swadesh 100 <a href="https://concepticon.clld.org/contributions/Swadesh-1971-100" class="w3-hover-opacity">(1971)</a>
    <br>
    <input type="radio" class="w3-radio" name="wordlist" value="sw207" onchange="toggleWordlistName(this)"/> Swadesh 207 <a href="https://cdstar.shh.mpg.de/bitstreams/EAEA0-BF5B-6FD1-C12C-0/Swadesh1952.pdf" class="w3-hover-opacity">(1952)</a>
    <br>
    <input type="radio" class="w3-radio" name="wordlist" value="asjp40" onchange="toggleWordlistName(this)"/> ASJP 40 <a href="https://asjp.clld.org/static/Guidelines.pdf" class="w3-hover-opacity">(2008)</a>
    <br>
    <input type="radio" class="w3-radio" name="wordlist" value="sw-yt35" onchange="toggleWordlistName(this)"/> Swadesh-Yakhontov 35 <a href="https://cdstar.eva.mpg.de/bitstreams/EAEA0-BA5C-CCFE-F501-0/Starostin1991.pdf" class="w3-hover-opacity">(1991)</a>
    <br>
    <input type="radio" class="w3-radio" name="wordlist" value="dp15" onchange="toggleWordlistName(this)"/> Dolgopolsky 15 <a href="https://cdstar.shh.mpg.de/bitstreams/EAEA0-F41D-6AB7-0B17-0/Dolgopolsky1964.pdf" class="w3-hover-opacity">(1964)</a>
    <br>
    <input type="radio" class="w3-radio" name="wordlist" value="ngsl" onchange="toggleWordlistName(this)"/> New General Service List <a href="https://www.newgeneralservicelist.com/new-general-service-list" class="w3-hover-opacity">(2013)</a>
    <br>
    <input type="radio" class="w3-radio" name="wordlist" value="sgn" onchange="toggleWordlistName(this)"/> Sign Language <a href="https://www.routledge.com/The-Signs-of-Language-Revisited-An-Anthology-To-Honor-Ursula-Bellugi-and/Emmorey-Lane/p/book/9781138003262" class="w3-hover-opacity">(2000)</a>
    <br>
    <input type="radio" class="w3-radio" name="wordlist" value="no-list" onchange="toggleWordlistName(this)"/> No Preset Wordlist Needed
    <br>
    <br>
  </div>
  <div class="input-group w3-height-custom" id="wordlist-name-group" style="display: none;">
  <label style="display: inline-block; width: 35%;"><h5><b>Wordlist Name:</b></h5></label>
  <input type="text" class="w3-input" id="wordlist-name" name="wordlist-name" placeholder="Type the name of the selected wordlist">
  </div>
  <br>
  <div class="w2-center">
    <input name="submit" type="submit" id="wordlist-pref" class="w3-button btn-outline-secondary w3-oxford-blue w3-margin-bottom" value="Next →" onclick="validateForm()">
    </div>
  </form>
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

function validateForm() {
  // Check if an option is selected
  var selectedOption = document.querySelector('input[name="wordlist"]:checked');
  if (!selectedOption) {
    alert("Please choose one of the options available; otherwise, you cannot proceed to the next step.");
    return false; // Prevent form submission
  }
  document.getElementById("wordlist-form").submit(); // Submit the form if an option is selected
}

function toggleWordlistName(radio) {
    var wordlistNameGroup = $("#wordlist-name-group");
    if (radio.value === "no-list") {
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
