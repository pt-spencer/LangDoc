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

$currentUserID = $_SESSION['user-id'];
?>

<!DOCTYPE html>
<html>
<head>
<title>To-Do</title>
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
    <a href="project.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-th-large fa-fw w3-margin-right"></i>MY PROJECTS</a> 
    <a href="to-do.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-check-square fa-fw w3-margin-right"></i><b>TO-DO</b></a> 
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
    <h1 class="header-title p-t-45 p-b-45"><b>To-do List</b></h1>

    </div>
  </header>

  
<div class="w3-container header-title m-b-45" style="height: 100px;">
<h1 class="p-t-15" style="text-align: center; ">TO COLLECT</h1>
</div>
<div class="w3-row-padding" style="margin:0 16px">
  <div class="w3-row-padding">

    <?php
// Fetch all projects belonging to the current user
$sqlAssignment = "SELECT * FROM `project-assignment` WHERE `user-id` = {$_SESSION['user-id']} AND `project-id` IN (
    SELECT DISTINCT w.`project-id`
    FROM `lexicon`.`entry` e
    JOIN `lexicon`.`wordlist` w ON e.`wordlist-id` = w.`wordlist-id`
    WHERE e.`entry-status` = 'not recorded'
)";
$resultAssignment = $mysqli->query($sqlAssignment);

// Array of available colors
$colors = array(
  '#F5D7DC', '#F2B5D4', '#F7E3D7', '#F9CFCF', '#FDEDEC',
  '#D4EFDF', '#D1F2EB', '#D6EAF8', '#D6DBDF', '#EAF2F8',
  '#F9E79F', '#F4D03F', '#FCF3CF', '#F8C471', '#FDEBD0',
  '#D2B4DE', '#C39BD3', '#D6EAF8', '#D5D8DC', '#EBDEF0',
  '#ABEBC6', '#A2D9CE', '#AED6F1', '#A9CCE3', '#E8DAEF'
);


while ($projectAssignment = $resultAssignment->fetch_assoc()) {
    // Start output buffering
    ob_start();

    $projectID = $projectAssignment['project-id'];
    $sqlProject = "SELECT * FROM `project` WHERE `project-no` = $projectID";
    $resultProject = $mysqli->query($sqlProject);
    $project = $resultProject->fetch_assoc();
    $projectName = $project['project-name'];


    $sqlUserRole = "SELECT `role` FROM `project-assignment` WHERE `user-id` = '$currentUserID' AND `project-id` = '$projectID'";
    $resultUserRole = $mysqli->query($sqlUserRole);

    
    if ($resultUserRole && $resultUserRole->num_rows > 0) {
      $currentUserRole = $resultUserRole->fetch_assoc()['role'];
    } else {
      $currentUserRole = '';
    }
    
    
    // Generate a random index to pick a color from the array
    $randomColorIndex = array_rand($colors);
    $randomColor = $colors[$randomColorIndex];

    $sqlToCollect = "SELECT w.`wordlist-id`, w.`wordlist-name`, COUNT(*) AS entry_count, SUM(CASE WHEN e.`entry-status` = 'not recorded' THEN 1 ELSE 0 END) AS unrecorded_count FROM `lexicon`.`entry` e JOIN `lexicon`.`wordlist` w ON e.`wordlist-id` = w.`wordlist-id` WHERE w.`project-id` = {$projectID} GROUP BY w.`wordlist-name`";
    $resultToCollect = $mysqli->query($sqlToCollect);

    if ($resultToCollect && $resultToCollect->num_rows > 0 && $currentUserRole == 'collector' || $currentUserRole == 'admin') {
        echo "<div class='w3-half w3-margin-bottom'>";
        echo "<div class='w3-padding w3-margin-bottom' style='background-color: {$randomColor}; border-radius: 10px; height: 200px; overflow-x: auto'>";
        echo '<h1 class="w3-text-dark-grey"><b>' . $projectName . '</b></h1>';
        echo "<table style='width: 95%;'>";
        while ($row = $resultToCollect->fetch_assoc()) {
            $wordlistName = $row['wordlist-name'];
            $wordlistID = $row['wordlist-id'];
            $entryCount = $row['entry_count'];
            $unrecordedCount = $row['unrecorded_count'];
            $percentage = round(($entryCount - $unrecordedCount) / $entryCount * 100, 2);
            echo "<tr><td><a href='informant-check.php?wordlist={$wordlistID}&project_id={$projectID}'><h3><b>▻&nbsp{$wordlistName}</b></h3></a></td>";
            echo "<td style='text-align: right;'><h3>{$percentage}%</h3></td></tr>";
        }
        echo "</table>";
        echo "</div>";
        echo "</div>";
    } 

    // End output buffering and display the output
    $output = ob_get_clean();
    echo $output;
}

?>
  </div>
</div>



  <div class="w3-container header-title m-t-45 m-b-45" style="height: 100px;">
<h1 class="p-t-15" style="text-align: center; ">TO REVISE</h1>
</div>
<div class="w3-row-padding" style="margin:0 16px">
  <div class="w3-row-padding">

    <?php
// Fetch all projects belonging to the current user
$sqlAssignment = "SELECT pa.*
FROM `project-assignment` pa
WHERE pa.`user-id` = {$_SESSION['user-id']}
AND pa.`project-id` IN (
    SELECT DISTINCT w.`project-id`
    FROM `lexicon`.`entry` e
    JOIN `lexicon`.`wordlist` w ON e.`wordlist-id` = w.`wordlist-id`
    WHERE e.`entry-status` = 'need a review'
)";
$resultAssignment = $mysqli->query($sqlAssignment);

// Array of available colors
$colours = array(
    '#F8C4CC', '#F5E1DF', '#F6D6E5', '#F9D6C5', '#F8DFC1',
    '#D1F0E7', '#D2F0F7', '#D1F7F2', '#D6E5F2', '#F0D4E7',
    '#F8E3C8', '#F5E2CA', '#F8DFC1', '#F7CFAA', '#F8E5C9',
    '#E1C4F5', '#DFC4F5', '#E8D1F7', '#E9EAEF', '#F5C4E6',
    '#BDF5DF', '#BCF5E2', '#C2F5F7', '#BEEBF4', '#E6D1F1'
);


while ($projectAssignment = $resultAssignment->fetch_assoc()) {
    // Start output buffering
    ob_start();

    $projectID = $projectAssignment['project-id'];
    $sqlProject = "SELECT * FROM `project` WHERE `project-no` = $projectID";
    $resultProject = $mysqli->query($sqlProject);
    $project = $resultProject->fetch_assoc();
    $projectName = $project['project-name'];


    $sqlUserRole = "SELECT `role` FROM `project-assignment` WHERE `user-id` = '$currentUserID' AND `project-id` = '$projectID'";
    $resultUserRole = $mysqli->query($sqlUserRole);

    if ($resultUserRole && $resultUserRole->num_rows > 0) {
    $currentUserRole = $resultUserRole->fetch_assoc()['role'];
    } else {
    $currentUserRole = '';
    }


    // Generate a random index to pick a color from the array
    $randomColourIndex = array_rand($colours);
    $randomColour = $colors[$randomColourIndex];

    $sqlToRevise = "SELECT w.`wordlist-id`, w.`wordlist-name`, COUNT(*) AS entry_count, 
                    SUM(CASE WHEN e.`entry-status` = 'need a review' THEN 1 ELSE 0 END) AS need_review_count, 
                    SUM(CASE WHEN e.`entry-status` = 'reviewed' THEN 1 ELSE 0 END) AS reviewed 
                    FROM `lexicon`.`entry` e JOIN `lexicon`.`wordlist` w ON e.`wordlist-id` = w.`wordlist-id`
                    WHERE w.`project-id` = {$projectID} GROUP BY w.`wordlist-name`";
    $resultToRevise = $mysqli->query($sqlToRevise);

    if ($resultToRevise && $resultToRevise->num_rows > 0 && $currentUserRole == 'analyser' || $currentUserRole == 'admin') {
        echo "<div class='w3-half w3-margin-bottom'>";
        echo "<div class='w3-padding w3-margin-bottom' style='background-color: {$randomColour}; border-radius: 10px; height: 200px; overflow-x: auto'>";
        echo '<h1 class="w3-text-dark-grey"><b>' . $projectName . '</b></h1>';
        echo "<table style='width: 95%;'>";
        while ($row = $resultToRevise->fetch_assoc()) {
            $wordlistToRevise = $row['wordlist-name'];
            $reviseID = $row['wordlist-id'];
            $reviewed = $row['reviewed'];
            $needReviewCount = $row['need_review_count'];
            if ($needReviewCount > 0) {
                $percent = round(100 - ((($needReviewCount + $reviewed) - $reviewed) / ($needReviewCount + $reviewed)) * 100, 2);
                echo "<tr><td><a href='revision.php?wordlist={$reviseID}&project_id={$projectID}'><h3><b>▻&nbsp{$wordlistToRevise}</b></h3></a></td>";
                echo "<td style='text-align: right;'><h3>{$percent}%</h3></td></tr>";
            } else {
        }
      }
        echo "</table>";
        echo "</div>";
        echo "</div>";
    }
    // End output buffering and display the output
    $output = ob_get_clean();
    echo $output;
}


?>
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
