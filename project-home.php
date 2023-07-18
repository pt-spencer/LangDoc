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

$projectID = $_GET['project_id'];

$currentUserID = $_SESSION['user-id'];

$sqlProject = "SELECT * FROM `project` WHERE `project-no` = '$projectID'";
$resultProject = $mysqli->query($sqlProject);

if ($resultProject && $resultProject->num_rows > 0) {
    $project = $resultProject->fetch_assoc();
}

?>

<!DOCTYPE html>
<html>
<head>
<title><?php echo $project['project-name'] ?></title>
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
  height: 50px;
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
<div class="w3-main" style="margin-left:300px;">

  <!-- Header -->
  <header id="projects">


    <!--<a href="#"><img src="/w3images/avatar_g2.jpg" style="width:65px;" class="w3-circle w3-right w3-margin w3-hide-large w3-hover-opacity"></a>-->
    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
    <div class="w3-container">
    <img src="images/logo-blue.png" style="height:100px;" class="w3-right w3-hide-small w3-hide-medium w3-animate-top">
    <?php if (isset($project)) { ?>
        <h1 class="header-title p-t-45"><b><?php echo $project['project-name'] ?></b></h1>
        <h4 class="p-b-45"><i><?php echo $project['project-affiliation'] ?></i></h4>
    <?php } ?>

    </div>
  </header>

  <div class="w3-row-padding" style="margin:0 16px">
  <h2><b>MEMBERS & ROLES </b></h2>
  <div class="w3-margin-bottom">
    <div style="border-radius: 5px;" class="w3-pale-grey w3-xlarge w3-padding-16">
    <?php
// Get all members of the group by project ID and join with the user table to get user name, role, and image
$sqlMembers = "SELECT `user`.`user-name`, `project-assignment`.`role`, `user`.`user-image` 
                FROM `project-assignment` JOIN `user` ON `project-assignment`.`user-id` = `user`.`user-id` 
                WHERE `project-assignment`.`project-id` = '$projectID' ORDER BY `user`.`user-name` ASC";
$resultMembers = $mysqli->query($sqlMembers);

if ($resultMembers && $resultMembers->num_rows > 0) {
  // Display the members in a horizontal scroll
  echo '<div style="overflow-x: auto; text-align: center; white-space: nowrap; display: flex; align-items: flex-start; height: 192px;">';
  while ($member = $resultMembers->fetch_assoc()) {
      echo '<div style="display: inline-block; margin-left: 25px; margin-right: 10px; width: 150px; flex-shrink: 0;">';
      echo '<img class="w3-circle" src="images/user/' . $member['user-image'] . '" style="width: 100px; height: 100px; border-radius: 50%;">';
      echo '<p class="p-t-5" style="font-weight: bold; font-size: 20px; color: #002147; line-height: 1.2; white-space: normal; display: block;">' . $member['user-name'] . '</p>';
      echo '<p class="p-t-5" style="font-size: 16px; line-height: 1; white-space: normal; display: block;">' . $member['role'] . '</p>';
      echo '</div>';
  }
  echo '</div>';
} else {
  echo '<p>No members found.</p>';
}
?>
    </div>
  </div>

  <?php
$sqlUserRole = "SELECT `role` FROM `project-assignment` WHERE `user-id` = '$currentUserID' AND `project-id` = '$projectID'";
$resultUserRole = $mysqli->query($sqlUserRole);

if ($resultUserRole && $resultUserRole->num_rows > 0) {
  $currentUserRole = $resultUserRole->fetch_assoc()['role'];
} else {
  $currentUserRole = '';
}



// Check if the current user is an admin
if ($currentUserRole == 'admin') {
    // Show the ASSIGN and ADD MEMBER buttons
    echo '<div class="w3-row-padding">';
    echo '<div class="w3-half w3-margin-bottom">';
    echo '<button onclick="window.location.href=\'assign.php?project_id=' . $projectID . '\';" type="button" class="w3-button w3-block w3-oxford-blue w3-xlarge w3-padding-40 button-height"><h6>ASSIGN AND MANAGE</h6></button>';
    echo '</div>';
    echo '<div class="w3-half w3-margin-bottom">';
    echo '<button onclick="window.location.href=\'add-project-member.php?project_id=' . $projectID . '\';" id="contribute-button" class="w3-button w3-block w3-oxford-blue w3-xlarge w3-padding-40 button-height"><h6>ADD MEMBER</h6></button>';
    echo '</div>';
    echo '</div>';
  }
?>
 

 <h2><b>WORK IN PROGRESS</b></h2>
<div class="w3-row-padding" style="margin:0 -15px">


<?php if ($currentUserRole == 'collector' || $currentUserRole == 'admin') { ?>
  <div class="w3-half w3-margin-bottom">
    <div id="to-collect" style="border-radius: 5px;height: 150px; overflow-y: auto;" class="w3-pale-grey w3-xlarge w3-padding-16">
    <?php
// Retrieve wordlist data with status 'not recorded'
require_once 'db_connection2.php';
$sqlToCollect = "SELECT w.`wordlist-id`, w.`wordlist-name`, COUNT(*) AS entry_count, SUM(CASE WHEN e.`entry-status` = 'not recorded' THEN 1 ELSE 0 END) AS unrecorded_count FROM `lexicon`.`entry` e JOIN `lexicon`.`wordlist` w ON e.`wordlist-id` = w.`wordlist-id` WHERE w.`project-id` = {$projectID} GROUP BY w.`wordlist-name`";
$resultToCollect = $mysqli->query($sqlToCollect);

if ($resultToCollect && $resultToCollect->num_rows > 0) {
    echo "<div class='w3-padding'>";
    echo "<table style='width: 95%;'>";
    while ($row = $resultToCollect->fetch_assoc()) {
        $wordlistName = $row['wordlist-name'];
        $wordlistID = $row['wordlist-id'];
        $entryCount = $row['entry_count'];
        $unrecordedCount = $row['unrecorded_count'];
        $percentage = round(($entryCount - $unrecordedCount) / $entryCount * 100, 2);
        echo "<tr><td><a href='informant-check.php?wordlist={$wordlistID}&project_id={$projectID}'><h3><b>&nbsp{$wordlistName}</b></h3></a></td>";
        echo "<td style='text-align: right;'>{$percentage}%</td></tr>";
    }
    echo "</table>";
    echo "</div>";
} else {
    echo '<div class="p-t-25" style="display: flex; justify-content: center; align-items: center; text-align: center">';
    echo '<h4><b>Hooray🥳</b><br>No word left behind.</h4></div>';
}
?>

    </div>
    <h3 style="text-align: center;">TO COLLECT</h3>
  </div>
<?php } 

if ($currentUserRole == 'analyser' || $currentUserRole == 'admin') { ?>

  <div class="w3-half w3-margin-bottom">
    <div id="to-revise" style="border-radius: 5px; height: 150px; overflow-y: auto;" class="w3-pale-grey w3-xlarge w3-padding-16">
    <?php
      // Retrieve wordlist data with status 'need a review'
      require_once 'db_connection2.php';
      $sqlToRevise = "SELECT w.`wordlist-id`, w.`wordlist-name`, COUNT(*) AS entry_count, 
                      SUM(CASE WHEN e.`entry-status` = 'need a review' THEN 1 ELSE 0 END) AS need_review_count, 
                      SUM(CASE WHEN e.`entry-status` = 'reviewed' THEN 1 ELSE 0 END) AS reviewed 
                      FROM `lexicon`.`entry` e JOIN `lexicon`.`wordlist` w ON e.`wordlist-id` = w.`wordlist-id`
                      WHERE w.`project-id` = {$projectID} GROUP BY w.`wordlist-name`";
      $resultToRevise = $mysqli->query($sqlToRevise);
      
      if ($resultToRevise && $resultToRevise->num_rows > 0) {
          echo "<div class='w3-padding'>";
          echo "<table style='width: 95%;'>";
          while ($row = $resultToRevise->fetch_assoc()) {
              $wordlistToRevise = $row['wordlist-name'];
              $reviseID = $row['wordlist-id'];
              $reviewed = $row['reviewed'];
              $needReviewCount = $row['need_review_count'];
              if ($needReviewCount > 0) {
                  $percent = round(100 - ((($needReviewCount + $reviewed) - $reviewed) / ($needReviewCount + $reviewed)) * 100, 2);
                  echo "<tr><td><a href='revision.php?wordlist={$reviseID}&project_id={$projectID}'><h3><b>&nbsp{$wordlistToRevise}</b></h3></a></td>";
                  echo "<td style='text-align: right;'>{$percent}%</td></tr>";
              } else {
                echo '<div class="p-t-25" style="display: flex; justify-content: center; align-items: center; text-align: center">';
                echo '<h4><b>Hooray🎉</b><br>No word need revision.</h4></div>';
          }
        }
        echo "</table>";
        echo "</div>";
      } else {
        echo '<div class="p-t-25" style="display: flex; justify-content: center; align-items: center; text-align: center">';
        echo '<h4><b>Hooray🎉</b><br>No word need revision.</h4></div>';
    }

/* LOGIC FOR REVISE
      $sqlToRevise = "SELECT w.`wordlist-id`, w.`wordlist-name`, COUNT(*) AS entry_count, 
                      SUM(CASE WHEN e.`entry-status` = 'need a review' THEN 1 ELSE 0 END) AS need_review_count, 
                      SUM(CASE WHEN e.`entry-status` = 'reviewed' THEN 1 ELSE 0 END) AS reviewed 
                      FROM `lexicon`.`entry` e JOIN `lexicon`.`wordlist` w ON e.`wordlist-id` = w.`wordlist-id`
                      WHERE w.`project-id` = {$projectID} GROUP BY w.`wordlist-name`";
      $resultToRevise = $mysqli->query($sqlToRevise);
      
      if ($resultToRevise && $resultToRevise->num_rows > 0) {
          echo "<div class='w3-padding'>";
          echo "<table style='width: 95%;'>";
          while ($row = $resultToRevise->fetch_assoc()) {
              $wordlistToRevise = $row['wordlist-name'];
              $reviseID = $row['wordlist-id'];
              $reviewed = $row['reviewed'];
              $needReviewCount = $row['need_review_count'];
              if ($needReviewCount > 0) {
                  $percent = round(($needReviewCount - $reviewed) / $needReviewCount * 100, 2);
              } else {
              $percent = 0;
          }
            echo "<tr><td><a href='revision.php?wordlist={$reviseID}&project_id={$projectID}'><h3><b>&nbsp{$wordlistToRevise}</b></h3></a></td>";
            echo "<td style='text-align: right;'>{$percent}%</td></tr>";
        }
        echo "</table>";
        echo "</div>";
      } else {
        echo '<div class="p-t-25" style="display: flex; justify-content: center; align-items: center; text-align: center">';
        echo '<h4><b>Hooray🎉</b><br>No word need revision.</h4></div>';
    } */
      ?>
    </div>
    <h3 style="text-align: center;">TO REVISE</h3>
  </div>
  <?php } ?>
</div>


<h2><b>WORDLIST</b></h2>
<div class="w3-row-padding" style="margin:0 -15px">
  <div class="w3-half w3-margin-bottom">
  <div class="w3-margin-bottom">
  <button onclick="location.href='project-list.php?project_id=<?php echo $projectID; ?>'" type="button" class="w3-button w3-block w3-oxford-blue w3-xlarge w3-padding-32 button-height" style="height: 67px;">OPEN LIST</button>  </div>
  
<?php  if ($currentUserRole == 'admin') { ?>
  <div class="w3-margin-bottom">
  <div class="w3-half" style="padding-right: 5px;">
    <button onclick="location.href='new-list.php?project_id=<?php echo $projectID; ?>';" type="button" class="w3-button w3-block w3-oxford-blue w3-xlarge w3-padding-32 button-height" style="height: 67px;">NEW LIST</button>
  </div>
  <div class="w3-half" style="padding-left: 5px;">
    <button onclick="location.href='add-to-list.php?project_id=<?php echo $projectID; ?>';" type="button" class="w3-button w3-block w3-oxford-blue w3-xlarge w3-padding-32 button-height" style="height: 67px;">ADD TO LIST</button>
  </div>
</div>
<?php }
if ($currentUserRole == 'admin' || $currentUserRole == 'collector') { ?>
  </div>
    <div class="w3-half w3-margin-bottom">
    <button onclick="location.href='choose-list.php?project_id=<?php echo $projectID; ?>';" type="button" class="w3-button w3-block w3-oxford-blue w3-xlarge w3-padding-32 button-height" style="height: 150px;"><b>Instant Word <br>Collection</b></button>
  </div>
  </div>
<?php } ?>
</div> 

<?php  if ($currentUserRole == 'admin') { ?>
  <div class="w3-container w3-margin-bottom">
  <h2 class="p-t-15"><b>PROJECT PREFERENCE</b>
<a href="preference.php?project_id=<?= $projectID ?>"><i class="fa fa-gear" style="color: #aaa; font-size: 32px;"></i></a>
</h2>
</div>
<?php } ?>

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
