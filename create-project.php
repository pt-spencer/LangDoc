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
.language-table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 10px;
}

.language-table td {
  padding: 10px;
  border-bottom: 1px solid #ccc;
}


.language-code-cell {
  width: 40%;
  vertical-align: middle;
  text-align: center;
  background-color: #ebf3f5; /* Add background color */
}

.language-code {
  margin: 0;
  font-size: 75px;
  font-weight: bold;
  color: #021933; /* Add font color */
  font-family: monospace;
}


.language-name-cell::after {
  content: "LANGUAGE";
  position: relative;
  top: 50%;
  right: 0px;
  transform: translateY(-50%);
  font-size: 14px;
  color: #888;
}

.language-scope-cell::after {
  content: "SCOPE";
  position: relative;
  top: 50%;
  right: 0px;
  transform: translateY(-50%);
  font-size: 14px;
  color: #888;
}

.language-type-cell::after {
  content: "STATUS";
  position: relative;
  top: 50%;
  right: 0px;
  transform: translateY(-50%);
  font-size: 14px;
  color: #888;
}

.language-name-cell,
.language-scope-cell,
.language-type-cell {
  vertical-align: middle;
  background-color: #fff; /* Add background color */
}

.language-name,
.language-scope,
.language-type {
  margin: 0;
  font-size: 24px;
  font-weight: bold;
  color: #002147; /* Add font color */
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

<div class="w3-container w3-padding-large w3-pale-grey">
  <h3 id="user-info"><b>Basic Information</b></h3>
  <form action="project-form.php" method="POST" id="project-regis">
    <div class="w3-section">
      <label><h4>Project Name</h4></label>
      <input class="w3-input w3-border" type="text" id="project-name" name="project-name" placeholder="Enter your project name" required>
    </div>
    <div class="w3-section">
      <label><h4>Project Affiliation</h4></label>
      <input class="w3-input w3-border" type="text" id="project-affiliation" name="project-affiliation" placeholder="Enter the project's affiliation" required>
    </div>
    <div class="w3-section">
      <label><h4>Language in study</h4></label>
      <div class="input-group d-flex">
        <input class="w3-input w3-border mr-2 autocomplete" type="text" id="project-language" name="project-language" placeholder="Enter the language name or the ISO 639-3 code" autocomplete="off" required>
      </div>
      <div class="col-md-5">
        <div class="list-group" id="lang-list"></div>
      </div>
    </div>
    <?php
    require_once 'db_connection.php';

    if (isset($_POST['select'])) {
      $language = $_POST['project-language'];
    
      $sql = "SELECT * FROM `language` WHERE `language-name` = ?";
      $stmt = $mysqli->prepare($sql);
      $stmt->bind_param('s', $language);
      $stmt->execute();
      $result = $stmt->get_result();
    
      if ($result->num_rows > 0) {
        // Fetch the first row from the result set
        $row = $result->fetch_assoc();
    
        // Retrieve the language ID
        $languageId = $row['language-id'];
    
        // Use the language ID in further processing
      } else {
        // Language not found, handle the error
      }
    }
    
    ?>
    <div class="w3-container language-info" style="display: none;"></div>
    <div class="w3-center">
      <input type="submit" name="submit" id="project-info" class="w3-button btn-outline-secondary w3-oxford-blue w3-margin-bottom" value="Next →">
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
</script>

<!--===============================================================================================-->
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script>
$(document).ready(function() {
    $("#project-language").keyup(function() {
        let searchText = $(this).val();
        if (searchText != "") {
            $.ajax({
                url: "language.php",
                method: "post",
                data: {
                    query: searchText
                },
                success: function(response) {
                    $("#lang-list").html(response);
                }
            })
        } else {
            $("#lang-list").html("");
        }
    })

    $(document).on('click', 'a', function() {
    var selectedLanguage = $(this).text(); // Get the selected language
    $("#project-language").val(selectedLanguage);
    $("#lang-list").html("");
    $.ajax({
        url: "language.php",
        method: "post",
        data: {
            language: selectedLanguage
        },
        success: function(response) {
            // Update the HTML with the fetched data
            $(".language-info").show();
            $(".language-info").html(response);
            // Show the language info section
            $(".language-info").slideDown(500);
        }
    });
});

});

</script>
<script>

</script>
<!--===============================================================================================-->

</body>
</html>
