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

$entryID = $_GET['entry_id'];

$wordlistID = $_GET['wordlist_id'];

$projectID = $_GET['project_id'];

$currentUserID = $_SESSION['user-id'];


include_once 'db_connection2.php';

$sqlWordlist = "SELECT * FROM `lexicon`.`wordlist` WHERE `wordlist-id` = '$wordlistID'";
$resultWordlist = $mysqli->query($sqlWordlist);

if ($resultWordlist && $resultWordlist->num_rows > 0) {
    $wordlist = $resultWordlist->fetch_assoc();
}


$sqlWord = "SELECT * FROM `lexicon`.`entry` WHERE `entry-id` = '$entryID'";
$resultWord = $mysqli->query($sqlWord);

if ($resultWordlist && $resultWord->num_rows > 0) {
    $entry = $resultWord->fetch_assoc();
}

$sqlDict = "SELECT * FROM `lexicon`.`dictionary` WHERE `entry-id` = '$entryID'";
$resultDict= $mysqli->query($sqlDict);

if ($resultDict && $resultDict->num_rows > 0) {
    $dictionary = $resultDict->fetch_assoc();
}

?>

<!DOCTYPE html>
<html>
<head>
<title><?php echo $entry['word'] ?></title>
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

#searchingWord {
  background-image: url('css/searchicon.png');
  background-position: 10px 13px;
  background-repeat: no-repeat;
  background-size: 20px 20px;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
  border-radius: 10px
}

#list-of-word td {
  font-size: 18px;
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

    </div>
  </header>

<div class="w3-row-padding">
<div class="w3-container"><br>
    <div class="w3-block w3-xlarge" style="text-align: center; background-color: #ddd; border-radius: 15px; padding: 10px 10px">
        <h1>ID <b><?php echo $entry['entry-id'] ?></b></h1>
        <h1 class="p-t-4" style="font-size: 40pt;"><b><?php echo $entry['word'] ?></b></h1>
    </div><br>
    <div style="padding: 0% 30%">
    <h2>POS&emsp;<b><?php echo $entry['POS']; ?></b></h2>
    <h2>Category&emsp;<b><?php if (isset($entry['category'])) { echo $entry['category']; } else {echo '-'; } ?></b></h2>
    </div><br>

    <div style="text-align: center;">
    <?php
    // Retrieve pronunciation data for the entry
    require_once 'db_connection2.php';
    $sqlPronunciation = "SELECT p.`IPA`, p.`collector-id` FROM `lexicon`.`dictionary` d JOIN `lexicon`.`pronunciation` p ON d.`pronunciation-id` = p.`pronunciation-id` WHERE d.`entry-id` = {$entryID}";
    $resultPronunciation = $mysqli->query($sqlPronunciation);

    if ($resultPronunciation && $resultPronunciation->num_rows > 0) {
        $pronunciation = $resultPronunciation->fetch_assoc();
        $IPA =  '/' . str_replace('/', '\/', $pronunciation['IPA']) . '/';
    } else {
        $IPA = 'No pronunciation data available';
    }
    ?>
    <div style="border: 5px solid black; border-radius: 15px; display: inline-block; ; padding: 0px 15px;">
    <h2 class='p-t-10'>IPA</h2>
    <h1 class="p-t-4" style="font-size: 45pt;"><b><?php echo $IPA ?></b></h2><br>
    <?php if (!empty($pronunciation['IPA'])) {
    // Retrieve collector and analyser data for the entry
    require_once 'db_connection.php';
    $sqlCollector = "SELECT u.`user-name`, p.`recorded-on` FROM `project`.`user` u JOIN `lexicon`.`pronunciation` p ON u.`user-id` = p.`collector-id` WHERE p.`entry-id` = {$entryID}";
    $sqlAnalyser = "SELECT u.`user-name`, d.`analysed-on` FROM `project`.`user` u JOIN `lexicon`.`dictionary` d ON u.`user-id` = d.`analyser-id` WHERE d.`entry-id` = {$entryID}";
    $resultCollector = $mysqli->query($sqlCollector);
    $resultAnalyser = $mysqli->query($sqlAnalyser);

    if ($resultCollector && $resultCollector->num_rows > 0) {
        $row = $resultCollector->fetch_assoc();
        $collectorName = $row['user-name'];
        $collected = $row['recorded-on'];
    } else {
        $collectorName = '-';
        $collected = '-';
    }

    if ($resultAnalyser && $resultAnalyser->num_rows > 0) {
        $row = $resultAnalyser->fetch_assoc();
        $analyserName = $row['user-name'];
        $analysed = $row['analysed-on'];
    } else {
        $analyserName = '-';
        $analysed = '-';
    }
    ?>
    
    <h3><b>collected by </b><?php echo $collectorName ?> on <?php echo $collected ?></h3>
    <h3><b>analysed by </b><?php echo $analyserName ?> on <?php echo $analysed ?></h3><br>
    <?php } ?>
    </div><br>
    </div>
    <div style="padding: 0% 15%; margin: 30px 0px">
    <div>
      <h2><b>Definition:</b><br>
      <h2><?php echo $entry['definition']; ?></h2>
    </div>
 
  </div>
    <br>

    <div>
    <?php if (!empty($pronunciation['note'])) { ?>
    <h2><b>NOTE</b></h2>
    <h2 class="p-t-4"><?php echo $pronunciation['note'] ?></h2><br>

    </div>
    </div>
    </div>
    <?php
// Retrieve IPA, collector, and informant data for the rejected form(s)
require_once 'db_connection.php';
$sql = "SELECT p.`IPA`, u.`user-name`, p.`collector-id`, p.`recorded-on` FROM `lexicon`.`pronunciation` p JOIN `project`.`user` u ON p.`collector-id` = u.`user-id` WHERE p.`entry-id` = {$entryID} AND p.`pronunciation-status` = 'rejected'";
$result = $mysqli->query($sql);

if ($result && $result->num_rows > 0) {
    ?>
    <div class="w3-container w3-padding-large w3-pale-grey">
        <h2><b>Rejected Form(s)</b></h2>
        <ul>
            <?php while ($row = $result->fetch_assoc()) {
                $informantID = $row['collector-id'];
                $IPA =  '/' . str_replace('/', '\/', $row['IPA']) . '/';
                $sqlInformant = "SELECT `informant-name` FROM `lexicon`.`informant` WHERE `informant-id` = {$informantID}";
                $resultInformant = $mysqli->query($sqlInformant);
                if ($resultInformant && $resultInformant->num_rows > 0) {
                    $informantName = $resultInformant->fetch_assoc()['informant-name'];
                } else {
                    $informantName = '-';
                }
                ?>
                <li>
                    <h2><b><?php echo "{$IPA}"; ?></b></h2>
                    <p>Informant: <b><?php echo "{$informantName}"; ?></b></p>
                    <p>Collected by <b><?php echo "{$row['user-name']}"; ?></b> on <?php echo "{$row['recorded-on']}"; ?></p>
                </li>
                
            <?php } ?>
        </ul>
    </div>
    <?php
} else {
    ?>
    <div class="w3-container w3-padding-large w3-pale-grey">
        <h2><b>Rejected Form(s)</b></h2>
        <p>No rejected forms found.</p>
    </div>
    <?php
    }
}
?>

    </div>

    </div>

<br>
<div style="text-align: center;">
  <button onclick="window.location.href='in-wordlist.php?project_id=<?php echo $projectID; ?>&wordlist_id=<?php echo $wordlistID; ?>';" type="button" class="w3-button w3-oxford-blue w3-padding-40"><h4><b>← Back</b></h4></button>
  <button onclick="window.location.href='edit-word.php?project_id=<?php echo $projectID; ?>&wordlist_id=<?php echo $wordlistID; ?>&entry_id=<?php echo $entryID; ?>';" type="button" class="w3-button w3-oxford-blue w3-padding-40"><h4><b>Edit</b></h4></button>
</div>
</div>
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



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
function redirectTo(url) {
    window.location.href = url;
}
</script>
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
