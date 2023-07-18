<?php
   session_start();
   ob_start();
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
   
   $wordlistID = $_GET['wordlist'];
   
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
      <title>Reviewing Data</title>
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
         .split {
         height: 100%;
         width: 50%;
         position: fixed;
         z-index: 1;
         top: 0;
         overflow-x: hidden;
         padding-top: 20px;
         }
         .left {
         left: 0;
         background-color: #111;
         }
         .right {
         right: 0;
         background-color: red;
         }
         .centered {
         position: absolute;
         top: 50%;
         left: 50%;
         transform: translate(-50%, -50%);
         text-align: center;
         }
         .w3-button-cl{border:none;display:inline-block;padding:4px 3px;vertical-align:middle;overflow:hidden;text-decoration:none;color:inherit;background-color:inherit;text-align:center;cursor:pointer;white-space:nowrap; border-radius: 5px}
         .w3-button-cl:hover{color:#002147!important;background-color:#ccc!important; transition: .2s}
      </style>
   </head>
   <body class="w3-light-grey w3-content" style="max-width:1600px">
      <!-- Sidebar/menu -->
      <nav class="w3-sidebar w3-collapse w3-oxford-blue w3-animate-left" style="z-index:3;width:300px;" id="mySidebar">
         <br>
         <div class="w3-container">
            <a href="#" onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-grey" title="close menu">
            <i class="fa fa-remove"></i>
            </a>
            <img src="images/user/<?php echo $user['user-image']?>" style="width:250px;" class="w3-circle-white"><br><br>
            <h2><b>
               <?php echo $user['user-name']; ?>
               </b>
            </h2>
            <p class="w3-text-light-grey">
            <h4>
               <?php echo $user['user-affiliation']; ?>
            </h4>
            </p>
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
      <div class="w3-container">
      <br>
      <div>
      <?php
// Connect to the database
require_once 'db_connection.php';
require_once 'db_connection2.php';

// Get the wordlist ID and entry ID from the query string
$wordlistID = $_GET['wordlist'];
$entryID = isset($_GET['entry_id']) ? $_GET['entry_id'] : null;


    // Retrieve the next entry in the list
    $sql = "SELECT * FROM `lexicon`.`entry` WHERE `wordlist-id` = {$wordlistID} AND `entry-status` = 'need a review' AND `entry-id` > '{$entryID}' ORDER BY `entry-id` ASC LIMIT 1";
    $result = $mysqli->query($sql);

    // Check if the next entry was found
    if ($result && $result->num_rows > 0) {
        // If it was, retrieve its data and display it on the screen
        $entry = $result->fetch_assoc();
        echo "<h1><b>ID {$entry['entry-id']}</b></h1>";
        echo "<div class=\"w3-block w3-xlarge\" style=\"text-align: center; border-radius: 15px; padding: 10px 10px\">";
        echo "<h1 class=\"p-t-4\" style=\"font-size: 45pt;\"><b>{$entry['word']}</b></h1>";
        echo "<span style=\"text-transform:uppercase;\"><h2><b>{$entry['POS']}</b></h2></span>";
        echo "<h3>{$entry['definition']}</h3>";
        echo "</div><br>";
         // Display the "Skip to Next Word" button
    $nextURL = "revision.php?project_id={$projectID}&wordlist={$wordlistID}&entry_id={$entry['entry-id']}";
    echo "<button id=\"next-button\" class=\"w3-button w3-oxford-blue w3-hover-oxford-blue w3-right\" onclick=\"window.location.href='{$nextURL}'\">Skip to Next Word</button>"; ?>
      </div>
      <br>

      <div class="w3-row" style="padding: 0% 8%">
         <div class="w3-col">
        
         <?php 
         
         // Replace <entry-id> with the actual entry ID you want to retrieve data for
        $entryID = $entry['entry-id'];

        // Execute the SQL query
        $sql = "SELECT * FROM `lexicon`.`pronunciation` WHERE `entry-id` = {$entryID} AND `pronunciation-status` = 'need analysis'";
        $result = mysqli_query($mysqli, $sql);

        // Check if the query was successful
        if ($result) {
        // Loop through the rows and display the data
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="w3-block w3-xlarge" style="background-color: #ddd; margin: 25px 0px; border-radius: 15px; padding: 15px 15px; display: flex;">';
            echo '<div class="w3-col b-" style="width: 92%">';
            echo '<form method="POST">';
            echo "<h1 style='font-size: 40pt'><b>" . $row['IPA'] . "</b></h1>";
            if (!empty($row['note'])) {
            echo "<b>Note: </b>" . $row['note'] . "<br><br>";
            }
            if (!empty($row['informant-id'])) {
            $informantID = $row['informant-id']; 
            $ifm = "SELECT * FROM `lexicon`.`informant` WHERE `informant-id` = {$informantID}";
            $query = mysqli_query($mysqli, $ifm);
            $informant = mysqli_fetch_assoc($query);
            echo "<b>Informant: </b>" . $informant['informant-name'] . "<br>";
            }
            echo "<b>Recorded on: </b>" . $row['recorded-on'] . "<br>";
            echo '<input type="hidden" name="pronunciation_id" value="' . $row['pronunciation-id'] . '">';
            echo '<input type="hidden" name="wordlist" value="' . $wordlistID . '">';
            echo '<input type="hidden" name="project_id" value="' . $projectID . '">';
            echo '<textarea class="w3-input w3-border" id="comment" name="comment" rows="2" cols="50" placeholder="Enter your comment if applicable" style="margin-top: 15px"></textarea>';
            echo '</div>';
            echo '<div class="w3-col" style="width: 8%">';
            echo '<button type="submit" name="accept"><i class="fa fa-check-square" style="color: #2e8b57; font-size: 41px;""></i></button><br>';
            echo '<button type="submit" name="reject"><i class="fa fa-window-close" style="color: #b00505; font-size: 35px;"></i></button>';
            echo '</form>';
            echo "</div>";
            echo "</div>";
            // Add more fields as needed
        }
        } else {
        // Handle the error
        echo "Error: " . mysqli_error($mysqli);
        }

    } else {
        // If the next entry was not found, output a message
        echo "<h2><i>No more entries to be reviewed in this wordlist.</i></h2>";
        echo "<h4>Be patient, we are redirecting you back to your project at the moment.</h4>";
        header("refresh:5;url=project-home.php?project_id=".urlencode($projectID));
    }
         ?>
         

               <?php
                // Get the current time
                $now = date('Y-m-d H:i:s');

                if (isset($_POST['accept'])) {
                // Get the selected pronunciation ID from the form data
                $pronunciationID = $_POST['pronunciation_id'];
                $wordlistID = $_POST['wordlist'];
                $projectID = $_POST['project_id'];

                // Update the pronunciation table
                $sql = "UPDATE `lexicon`.`pronunciation` SET `pronunciation-status` = 'accepted', `note` = '{$_POST['comment']}' WHERE `pronunciation-id` = {$pronunciationID}";
                $result = mysqli_query($mysqli, $sql);

                // Update the pronunciation table for all other words in the list
                $sql = "UPDATE `lexicon`.`pronunciation` SET `pronunciation-status` = 'rejected' WHERE `entry-id` = {$entryID} AND `pronunciation-id` != {$pronunciationID}";
                $result = mysqli_query($mysqli, $sql);

                // Update the entry table
                $sql = "UPDATE `lexicon`.`entry` SET `entry-status` = 'reviewed' WHERE `entry-id` = {$entryID}";
                $result = mysqli_query($mysqli, $sql);

                // Update the dictionary table
                $sql = "INSERT INTO `lexicon`.`dictionary` (`entry-id`, `pronunciation-id`, `analyser-id`, `analysed-on`) VALUES ({$entryID}, {$pronunciationID}, {$currentUserID}, '{$now}')";
                $result = mysqli_query($mysqli, $sql);

                header("Location: revision.php?project_id={$projectID}&wordlist={$wordlistID}");


                } elseif (isset($_POST['reject'])) {
                // Get the selected pronunciation ID from the form data
                $pronunciationID = $_POST['pronunciation_id'];

                // Update the pronunciation table
                $sql = "UPDATE `lexicon`.`pronunciation` SET `pronunciation-status` = 'rejected', `note` = '{$_POST['comment']}' WHERE `pronunciation-id` = {$pronunciationID}";
                $result = mysqli_query($mysqli, $sql);

                header("Location: revision.php?project_id={$projectID}&wordlist={$wordlistID}");
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
        const nextButton = document.getElementById('next-button');
        nextButton.addEventListener('click', () => {
        // Call PHP script to retrieve next entry
        const xhr = new XMLHttpRequest();
        xhr.open('GET', '<?php echo $nextURL; ?>', true);
        xhr.onload = () => {
            if (xhr.status === 200) {
            // Update HTML with new entry data
            const entry = JSON.parse(xhr.responseText);
            document.querySelector('h1').innerHTML = `<b>ID ${entry['entry-id']}</b>`;
            document.querySelector('h1 + div h1').innerHTML = `<b>${entry['word']}</b>`;
            document.querySelector('h1 + div h2 b').innerHTML = entry['POS'];
            document.querySelector('h1 + div h3').innerHTML = entry['definition'];
            document.getElementById('next-button').setAttribute('onclick', `location.href='${entry['nextURL']}'`);
            }
        };
        xhr.send();
        });
        </script>
      <script>
         function validateForm() {
           var IPA = document.forms["pronuncitation"]["IPA"].value;
           if (IPA == "") {
             alert("IPA must be filled out");
             return false;
           }
           return true;
         }
         
         function redirectTo(url) {
             window.location.href = url;
         }
         
         function alpha(item) {
             var input = document.pronuncitation.IPA;
             if (document.selection) {
                 input.focus();
                 range = document.selection.createRange();
                 range.text = item;
                 range.select();
             }
             else if (input.selectionStart || input.selectionStart === '0') {
                 var startPos = input.selectionStart;
                 var endPos = input.selectionEnd;
                 var cursorPos = startPos;
                 var scrollTop = input.scrollTop;
                 var baselength = 0;
                 input.value = input.value.substring(0, startPos)
                     + item
                     + input.value.substring(endPos, input.value.length);
                 cursorPos += item.length;
                 input.focus();
                 input.selectionStart = cursorPos;
                 input.selectionEnd = cursorPos;
                 input.scrollTop = scrollTop;
             }
             else {
                 input.value += item;
                 input.focus();
             }
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