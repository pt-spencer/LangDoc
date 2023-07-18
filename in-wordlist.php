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

$wordlistID = $_GET['wordlist_id'];

$projectID = $_GET['project_id'];

$currentUserID = $_SESSION['user-id'];


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
<title>Wordlist</title>
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
        <h1 class="header-title p-t-45"><b><?php echo $wordlist['wordlist-name'] ?></b></h1><br>

    </div>
  </header>

<div class="w3-row-padding">

<div class="col-md-12">

<input type="text" id="searchingWord" onkeyup="filterWord()" placeholder="Search for word" title="Type in a word">

<div style="text-align: right;">
    <button class="w3-button w3-oxford-blue" onclick="redirectTo('add-entry.php?project_id=<?= $projectID ?>&wordlist_id=<?= $wordlistID ?>')">Add to list</button>
</div>

<div class="card mt-4">
<table class="table" id="list-of-word">

<thead>
   <tr>
    <th><h4>ID</h4></th>
    <th><h4>Word</h4></th>
    <th><h4>Part of Speech</h4></th>
    <th><h4>IPA</h4></th>
    </tr>
</thead>
<tbody>
<?php 
    if(isset($wordlistID))
    {
      $sqlWordlist = "SELECT e.`entry-id`, e.word, e.POS, e.`entry-status`, d.`pronunciation-id`, p.IPA
      FROM entry e
      LEFT JOIN dictionary d ON e.`entry-id` = d.`entry-id`
      LEFT JOIN pronunciation p ON d.`pronunciation-id` = p.`pronunciation-id`
      WHERE e.`wordlist-id` = $wordlistID";
        $resultWordlist = $mysqli->query($sqlWordlist);

        if(mysqli_num_rows($resultWordlist) > 0)
        {
            foreach($resultWordlist as $entry)
            {
                ?>
                <tr>
                    <td><?= $entry['entry-id']; ?></td>
                    <td>
                        <?php
                            if($entry['entry-status'] == 'reviewed')
                            {
                                ?>
                                <span class="fa fa-circle" style="color:green"></span>
                                <?php
                            }
                            elseif($entry['entry-status'] == 'need a review')
                            {
                                ?>
                                <span class="fa fa-circle" style="color:red"></span>
                                <?php
                            }
                            else
                            {
                                ?>
                                <span class="fa fa-circle" style="color:lightgrey"></span>
                                <?php
                            }
                        ?>&nbsp;
                    <b><a href="word.php?entry_id=<?= $entry['entry-id']; ?>&wordlist_id=<?= $wordlistID?>&project_id=<?= $projectID?>" style="font-size: 18px;"><?= $entry['word']; ?></a></b></td>
                    <td><?= $entry['POS']; ?></td>
                    <td><?= $entry['IPA']; ?></td>
                </tr>
                <?php
            }
        }
        else
        {
            ?>
                <tr>
                    <td colspan="4">No Record Found</td>
                </tr>
            <?php
        }
    }
?>
</tbody>
</table>
</div>
</div>
</div>


<br>
<div style="text-align: center;">
  <button onclick="window.location.href='project-list.php?project_id=<?php echo $projectID; ?>';" type="button" class="w3-button w3-oxford-blue w3-padding-40"><h4><b>← Back</b></h4></button>
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
function filterWord() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchingWord");
  filter = input.value.toUpperCase();
  table = document.getElementById("list-of-word");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

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
