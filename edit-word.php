<?php
session_start();
ob_start();

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

$projectID = $_GET['project_id'];

$wordlistID = $_GET['wordlist_id'];

$entryID = $_GET['entry_id'];

$currentUserID = $_SESSION['user-id'];

$sqlProject = "SELECT * FROM `project` WHERE `project-no` = '$projectID'";
$resultProject = $mysqli->query($sqlProject);

if ($resultProject && $resultProject->num_rows > 0) {
    $project = $resultProject->fetch_assoc();
}

include_once 'db_connection2.php';

$sqlWordlist = "SELECT * FROM `lexicon`.`wordlist` WHERE `wordlist-id` = '$wordlistID'";
$resultWordlist = $mysqli->query($sqlWordlist);

if ($resultWordlist && $resultWordlist->num_rows > 0) {
    $wordlist = $resultWordlist->fetch_assoc();
}


?>

<!DOCTYPE html>
<html>
<head>
<title>Editing the Word</title>
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
    <?php 
    $sqlWord = "SELECT * FROM `entry` w JOIN `dictionary` d ON w.`entry-id` = d.`entry-id` WHERE w.`entry-id` = $entryID";    
    $resultWord = $mysqli->query($sqlWord);
    $word = mysqli_fetch_assoc($resultWord);
    
    
    if (isset($project)) { ?>
        <h1 class="header-title p-t-45"><b>Edit the entry <i><?php echo $word['word'] ?></i></b></h1><br>
    <?php } ?>

    </div>
  </header>
  
  <div class="w3-container w3-padding-large w3-pale-grey">
    <form method="POST" id="add-entry">
      <div class="w3-section">
        <label><h4>Word</h4></label>
        <input class="w3-input w3-border" type="text" id="entry-word" name="entry-word" placeholder="<?php if (!empty($word['word'])) { echo $word['word']; } else {echo 'Enter head word or morpheme';} ?>">
      </div>
      <div class="w3-section">
        <label><h4>Part of Speech</h4></label>
        <input class="w3-input w3-border" type="text" id="entry-pos" name="entry-pos" placeholder="<?php if (!empty($word['POS'])) { echo $word['POS']; } else {echo 'Enter grammatical class of the word above';} ?>">
      </div>
      <div class="w3-section">
        <label><h4>Category (Optional)</h4></label>
        <input class="w3-input w3-border" type="text" id="entry-cat" name="entry-cat" placeholder="<?php if (!empty($word['category'])) { echo $word['category']; } else {echo 'This can be a part of speech specification or semantic category';} ?>">
      </div>
      <div class="w3-section">
        <label><h4>Semantic Meaning</h4></label>
        <textarea class="w3-input w3-border" id="entry-def" name="entry-def" rows="5" cols="50" placeholder="<?php if (!empty($word['definition'])) { echo $word['definition']; } else {echo 'Enter the definition or description of the word above';} ?>"></textarea>      </div>
        <div class="text-center sign-message sign-message-error" id="pass-error">
					</div><br>
      <button type="submit" class="w3-button w3-black w3-margin-bottom"><h5>Save the change</h5></button>
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


<?php
if (isset($_POST['entry-word']) && isset($_POST['entry-pos']) && isset($_POST['entry-cat']) && isset($_POST['entry-def'])) {
  $entry_word = $_POST['entry-word'];
  $entry_pos = $_POST['entry-pos'];
  $entry_cat = $_POST['entry-cat'];
  $entry_def = $_POST['entry-def'];

  $query = "UPDATE `lexicon`.`entry` SET";
  $fields = array();

  if (!empty($wordlistID)) {
      $fields[] = "`wordlist-id` = '$wordlistID'";
  }

  if (!empty($entry_word)) {
    $fields[] = "`word` = '$entry_word'";
  }

  if (!empty($entry_pos)) {
      $fields[] = "`POS` = '$entry_pos'";
  }

  if (!empty($entry_cat)) {
      $fields[] = "`category` = '$entry_cat'";
  }

  if (!empty($entry_def)) {
      $fields[] = "`definition` = '$entry_def'";
  }

  if (!empty($fields)) {
      $query .= " " . implode(", ", $fields);

      $result = $mysqli->query($query);
      header("Location: word.php?project_id=".urlencode($projectID)."&wordlist_id=".urlencode($wordlistID)."&entry_id=".urlencode($entryID));
      ob_end_flush();

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
=
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