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
  } elseif (isset($_GET['affiliation'])) {
      $userAffiliation = $_GET['affiliation'];
  }
}

$projectID = $_GET['project_id'];

$sqlProject = "SELECT * FROM `project` WHERE `project-no` = '$projectID'";
$resultProject = $mysqli->query($sqlProject);

if ($resultProject && $resultProject->num_rows > 0) {
        $project = $resultProject->fetch_assoc();
}

$currentUserID = $_SESSION['user-id'];

$sqlRole = "SELECT `user`.`user-id`, `user`.`user-name`, `project-assignment`.`role`, `user`.`user-image` 
               FROM `project-assignment` JOIN `user` ON `project-assignment`.`user-id` = `user`.`user-id` 
               WHERE `project-assignment`.`project-id` = '$projectID' AND `project-assignment`.`user-id` = '$currentUserID'";

$resultRole = $mysqli->query($sqlRole);

if ($resultRole && $resultRole->num_rows > 0) {
    $currentUserRole = $resultRole->fetch_assoc()['role'];
} else {
    $currentUserRole = '';
}

if ($currentUserRole !== 'admin') {
    echo "<script>alert('HOW DARE YOU! You are not authorized to access this page!')</script>";
    header("Location: signout.php?user-name=".urlencode($username));
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Add Project Member</title>
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

.w3-height-custom {
  height: 40px;
}
.button{border:none;display:inline-block;padding:5px 15px;vertical-align:middle;overflow:hidden;text-decoration:none;color:inherit;background-color:inherit;text-align:center;cursor:pointer;white-space:nowrap; border-radius: 5px}
.button:hover{color:#002147!important;background-color:#ccc!important; transition: .2s}
.button {
  display: flex;
  align-items: center;
  justify-content: center;
}

.button-text {
  display: flex;
  align-items: center;
  justify-content: center;
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
        <?php if (isset($project)) { ?>
                <h1 class="header-title p-t-45"><b><?php echo $project['project-name'] ?></b></h1>
                <h4 class="p-b-45"><i><?php echo $project['project-affiliation'] ?></i></h4>
        <?php } ?>

        </div>
    </header>

  <div class="w3-container w3-padding-large w3-pale-grey">
  <h3><b>Add People to <?php echo $project['project-name'] ?></b></h3>

    <div class="w3-section">
      <div class="input-group d-flex">
        <input class="w3-input w3-border w3-height-custom mr-2 autocomplete" type="text" id="member-search" name="member-search" placeholder="Search for new project member" autocomplete="off">
        <button type="submit" name="add-member" id="add-member" class="button w3-oxford-blue btn-outline-secondary w3-height-custom">
          <span class="button-text"><h5>add</h5></span>
        </button>
      </div>
      <div class="col-md-5">
        <div class="list-group" id="user-list"></div>
      </div>
    </div>

    <div style="text-align: center;">
      <h5>
        <ul style="display: inline-block; text-align: left; line-height: 2;" id="member-list"></ul>
      </h5>
    </div>


<div style="text-align: center;">
  <button onclick="window.location.href='project-home.php?project_id=<?php echo $projectID; ?>';" type="button" class="w3-button w3-oxford-blue w3-padding-40"><h4><b>Save</b></h4></button>
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
<!--===============================================================================================-->
<?php
// Initialize the member list as an empty array
$memberList = array();

if (isset($_SESSION['member-list'])) {
    $memberList = $_SESSION['member-list'];
}
?>

<script>
$(document).ready(function() {
    <?php
    if (!isset($_SESSION['member-list'])) {
        $_SESSION['member-list'] = []; // Initialize member list as an empty array
    }

    $memberList = $_SESSION['member-list'];
    ?>
    

    // Function to add a member to the list
    function addMemberToList(memberName) {
  $.ajax({
    url: 'member.php',
    type: 'POST',
    data: {
      userName: memberName,
      project_id: <?php echo $projectID ?>
    },
    success: function(response) {
      var memberAffiliation = response; // Set the retrieved affiliation
      if (memberAffiliation !== "") {
        var member = "<b>" + memberName + "</b>, " + memberAffiliation;
        var bulletPoint = $("<li>").html(member); // Use .html() instead of .text()
        $("#member-list").append(bulletPoint);
      }
    },
    error: function(xhr, status, error) {
      console.log("Error occurred while adding member to the list.");
    }
  });
}



    // Event handler for the add-member button click
    $("#add-member").click(function() {
        var memberName = $("#member-search").val(); // Get the entered member name

        if (memberName !== "") {
            addMemberToList(memberName); // Add the member to the list
            $("#member-search").val(""); // Clear the input field
        }
    });

    $("#member-search").keyup(function() {
        let searchText = $(this).val();
        if (searchText !== "") {
            $.ajax({
                url: "member.php",
                method: "post",
                data: {
                    query: searchText,
                    memberList: <?php echo json_encode($memberList); ?>
                },
                success: function(response) {
                    $("#user-list").html(response);
                }
            });
        } else {
            $("#user-list").html("");
        }
    });

    $(document).on('click', 'a', function() {
        var selectedMember = $(this).text(); // Get the selected member name

        $("#member-search").val(selectedMember); // Set the selected member's name in the search input field
        $("#user-list").html(""); // Clear the user list

        $.ajax({
            url: "member.php",
            method: "POST",
            data: { userName: selectedMember },
            success: function(response) {
                // Handle the response from the server
                var affiliation = response.userAffiliation; // Assuming the response is the affiliation value returned from PHP
                // Do something with the affiliation value
            },
            error: function(xhr, status, error) {
                // Handle any error that occurred during the AJAX request
            }
        });
    });
});

</script>

</body>
</html>
