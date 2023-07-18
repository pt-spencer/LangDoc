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
   
   $wordlistID = $_GET['wordlist_id'];
   
   $projectID = $_GET['project_id'];
   
   $currentUserID = $_SESSION['user-id'];
   
   $informantID  = $_GET['informant_id'];
   
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
      <title>Data Collection</title>
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
$wordlistID = $_GET['wordlist_id'];
$entryID = isset($_GET['entry_id']) ? $_GET['entry_id'] : null;


    // Retrieve the next entry in the list
    $sql = "SELECT * FROM `lexicon`.`entry` WHERE `wordlist-id` = {$wordlistID} AND `entry-status` = 'not recorded' AND `entry-id` > '{$entryID}' ORDER BY `entry-id` ASC LIMIT 1";
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
    $nextURL = "collection.php?project_id={$projectID}&wordlist_id={$wordlistID}&entry_id={$entry['entry-id']}&informant_id={$informantID}";
    echo "<button id=\"next-button\" class=\"w3-button w3-oxford-blue w3-hover-oxford-blue w3-right\" onclick=\"window.location.href='{$nextURL}'\">Skip to Next Word</button>"; ?>

      </div>
      <br>
      <div class="w3-row" style="padding: 0% 8%">
         <div class="w3-col" style="width: 40%">
            <form name="pronuncitation" action="collection.php?project_id=<?php echo $projectID ?>&wordlist_id=<?php echo $wordlistID ?>&informant_id=<?php echo $informantID ?>&entry_id=<?php echo $entry['entry-id'] ?>" method="POST" onsubmit="return validateForm()">
               <label>
                  <h4><b>IPA</b></h4>
               </label>
               <input class="w3-input w3-border" type="text" id="IPA" onKeyUp="transcrire()" name="IPA" placeholder="Type your IPA" required><br>
               <script>
                  var clipboard = new Clipboard('.bf');
                  clipboard.on('success', function(e) {
                      console.log(e);
                  });
                  clipboard.on('error', function(e) {
                      console.log(e);
                  });
               </script>
               <label>
                  <h4><b>Comment</b></h4>
               </label>
               <textarea class="w3-input w3-border" id="comment" name="comment" rows="7" cols="50" placeholder="Enter your comment if applicable"></textarea>
               <input type="hidden" name="entry_id" value="<?php echo $entry['entry-id']; ?>">
               <input type="hidden" name="wordlist_id" value="<?php echo $wordlistID; ?>">
               <input type="hidden" name="informant_id" value="<?php echo $informantID; ?>">
               <input type="hidden" name="project_id" value="<?php echo $projectID; ?>">
               <br>
               <div style="text-align: center;">
                  <input name="submit" type="submit" id="informant-submit" class="w3-button btn-outline-secondary w3-oxford-blue w3-margin-bottom" value="Save">        
               </div>
               <?php
                  // Check if the form was submitted
                  if (isset($_POST['IPA'])) {
                          $entryID = $_POST['entry_id'];
                          $IPA = $_POST['IPA'];
                          $informantID = $_POST['informant_id'];
                          $collectorID = $_SESSION['user-id'];
                          $note = $_POST['comment'];
                          
                          $sql = "INSERT INTO `lexicon`.`pronunciation` (`entry-id`, `IPA`, `informant-id`, `collector-id`, `recorded-on`, `note`) VALUES ('{$entryID}', '{$IPA}', '{$informantID}', '{$collectorID}', NOW(), '{$note}')";
                          $mysqli->query($sql);
                  
                          $stmt = $mysqli->prepare("UPDATE `lexicon`.`entry` SET `entry-status` = 'need a review' WHERE `entry-id` = ?");
                          $stmt->bind_param("i", $entryID);
                          $stmt->execute();
                          
                          header("Location: collection.php?project_id={$projectID}&wordlist_id={$wordlistID}&informant_id={$informantID}");
                          ob_end_flush();
                      }
                  ?>
            </form>
         </div>
         <div class="w3-col p-l-45" style="width: 60%">
            <br><br>
            <table class="tab-kb" style="font-size: 16pt">
               <tr>
                  <td>
                     <h5><b>Consonants</b></h5>
                     <input type="button" class="w3-button-cl" onclick="alpha('ɓ')" value="ɓ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ʙ')" value="ʙ">
                     <input type="button" class="w3-button-cl" onclick="alpha('β')" value="β">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɕ')" value="ɕ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ç')" value="ç">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɗ')" value="ɗ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɖ')" value="ɖ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ð')" value="ð">
                     <input type="button" class="w3-button-cl" onclick="alpha('ʤ')" value="ʤ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɟ')" value="ɟ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ʄ')" value="ʄ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɡ')" value="ɡ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɠ')" value="ɠ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɢ')" value="ɢ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ʛ')" value="ʛ">
                     <br>
                     <input type="button" class="w3-button-cl" onclick="alpha('ɦ')" value="ɦ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɧ')" value="ɧ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ħ')" value="ħ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ʜ')" value="ʜ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ʝ')" value="ʝ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɭ')" value="ɭ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɬ')" value="ɬ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɫ')" value="ɫ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɮ')" value="ɮ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ʟ')" value="ʟ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ʎ')" value="ʎ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɱ')" value="ɱ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɰ')" value="ɰ">
                     <br>
                     <input type="button" class="w3-button-cl" onclick="alpha('ŋ')" value="ŋ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɳ')" value="ɳ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɲ')" value="ɲ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɴ')" value="ɴ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɸ')" value="ɸ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɹ')" value="ɹ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɻ')" value="ɻ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɺ')" value="ɺ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɾ')" value="ɾ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɽ')" value="ɽ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ʀ')" value="ʀ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ʁ')" value="ʁ">
                     <br>
                     <input type="button" class="w3-button-cl" onclick="alpha('ʂ')" value="ʂ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ʃ')" value="ʃ">
                     <input type="button" class="w3-button-cl" onclick="alpha('θ')" value="θ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ʈ')" value="ʈ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ʧ')" value="ʧ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ʋ')" value="ʋ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɣ')" value="ɣ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ʍ')" value="ʍ">
                     <input type="button" class="w3-button-cl" onclick="alpha('χ')" value="χ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ʑ')" value="ʑ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ʐ')" value="ʐ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ʒ')" value="ʒ">
                  </td>
                  <td class="espr p-l-15">&nbsp;</td>
                  <td>
                     <h5><b>Vowels</b></h5>
                     <input type="button" class="w3-button-cl" onclick="alpha('ɑ')" value="ɑ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɐ')" value="ɐ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɒ')" value="ɒ">
                     <input type="button" class="w3-button-cl" onclick="alpha('æ')" value="æ">
                     <br>
                     <input type="button" class="w3-button-cl" onclick="alpha('ə')" value="ə">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɘ')" value="ɘ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɵ')" value="ɵ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɚ')" value="ɚ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɛ')" value="ɛ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɜ')" value="ɜ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɝ')" value="ɝ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɞ')" value="ɞ">
                     <br>
                     <input type="button" class="w3-button-cl" onclick="alpha('ɨ')" value="ɨ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɪ')" value="ɪ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɔ')" value="ɔ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ø')" value="ø">
                     <input type="button" class="w3-button-cl" onclick="alpha('œ')" value="œ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɶ')" value="ɶ">
                     <br>
                     <input type="button" class="w3-button-cl" onclick="alpha('ɥ')" value="ɥ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ʌ')" value="ʌ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ʊ')" value="ʊ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ʉ')" value="ʉ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɯ')" value="ɯ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ɤ')" value="ɤ">
                     <input type="button" class="w3-button-cl" onclick="alpha('ʏ')" value="ʏ">
                  </td>
               </tr>
            </table>
            </td>
            </tr>
            </table>
            <br>
            <div>
               <div class="w3-half" style="font-size: 16pt">
                  <input type="button" class="w3-button-cl" onclick="alpha('&#660;')" value="&#660;">
                  <input type="button" class="w3-button-cl" onclick="alpha('&#673;')" value="&#673;">
                  <input type="button" class="w3-button-cl" onclick="alpha('&#661;')" value="&#661;">
                  <input type="button" class="w3-button-cl" onclick="alpha('&#674;')" value="&#674;">
                  <input type="button" class="w3-button-cl" onclick="alpha('ʘ')" value="ʘ">
                  <input type="button" class="w3-button-cl" onclick="alpha('ǀ')" value="ǀ">
                  <input type="button" class="w3-button-cl" onclick="alpha('ǃ')" value="ǃ">
                  <input type="button" class="w3-button-cl" onclick="alpha('ǂ')" value="ǂ">
                  <input type="button" class="w3-button-cl" onclick="alpha('ǁ')" value="ǁ">
               </div>
               <div class="w3-half" style="font-size: 16pt">
                  <h5><b>Suprasegmentals</b></h5>
                  <input type="button" class="w3-button-cl" title="primary stress mark" onclick="alpha('&#712;')" value="&#712;">
                  <input type="button" class="w3-button-cl" title="secondary stress" onclick="alpha('&#716;')" value="&#716;">
                  <input type="button" class="w3-button-cl" title="length mark" onclick="alpha('&#720;')" value="&#720;">
                  <input type="button" class="w3-button-cl" title="half-length" onclick="alpha('&#721;')" value="&#721;">
                  <input type="button" class="w3-button-cl" title="ejective" onclick="alpha('&#700;')" value="&#700;">
                  <input type="button" class="w3-button-cl" title="rhotacized" onclick="alpha('&#692;')" value="&#692;">
                  <input type="button" class="w3-button-cl" title="aspirated" onclick="alpha('&#688;')" value="&#688;">
                  <input type="button" class="w3-button-cl" title="breathy-voice-aspirated" onclick="alpha('&#689;')" value="&#689;">
                  <input type="button" class="w3-button-cl" title="palatalized" onclick="alpha('&#690;')" value="&#690;">
                  <input type="button" class="w3-button-cl" title="labialized" onclick="alpha('&#695;')" value="&#695;">
                  <input type="button" class="w3-button-cl" title="velarized" onclick="alpha('&#736;')" value="&#736;">
                  <input type="button" class="w3-button-cl" title="pharyngealized" onclick="alpha('&#740;')" value="&#740;">
                  <input type="button" class="w3-button-cl" title="rhotacized" onclick="alpha('&#734;')" value="&#734;">
               </div>
            </div>
            <br>
            <div>
               <h5><b>Diacritics</b></h5>
               <div style="font-size: 16pt">
                  <input type="button" class="w3-button-cl" title="nasalized" onclick="alpha('&#771;')" value="&nbsp;&#771;">
                  <input type="button" class="w3-button-cl" title="velarized or pharyngealized" onclick="alpha('&#820;')" value="&nbsp;&#820;">
                  <input type="button" class="w3-button-cl" title="voiceless" onclick="alpha('&#778;')" value="&nbsp;&#778;">
                  <input type="button" class="w3-button-cl" title="extra-short" onclick="alpha('&#774;')" value="&nbsp;&#774;">
                  <input type="button" class="w3-button-cl" title="centralized" onclick="alpha('&#776;')" value="&nbsp;&#776;">
                  <!-- input type="button" class="w3-button-cl" onclick="alpha('&#619;')" value="&nbsp;&#619;" -->
                  <input type="button" class="w3-button-cl" title="mid-centralized" onclick="alpha('&#829;')" value="&nbsp;&#829;">
                  <input type="button" class="w3-button-cl" title="not audibly released" onclick="alpha('&#794;')" value="&nbsp;&#794;">
                  <input type="button" class="w3-button-cl" title="extra high tone" onclick="alpha('&#779;')" value="&nbsp;&#779;">
                  <input type="button" class="w3-button-cl" title="high tone" onclick="alpha('&#769;')" value="&nbsp;&#769;">
                  <input type="button" class="w3-button-cl" title="mid ton" onclick="alpha('&#772;')" value="&nbsp;&#772;">
                  <input type="button" class="w3-button-cl" title="lox tone" onclick="alpha('&#768;')" value="&nbsp;&#768;">
                  <input type="button" class="w3-button-cl" title="extra low tone" onclick="alpha('&#783;')" value="&nbsp;&#783;">
                  <input type="button" class="w3-button-cl" title="rising tone" onclick="alpha('&#780;')" value="&nbsp;&#780;">
                  <input type="button" class="w3-button-cl" title="falling tone" onclick="alpha('&#770;')" value="&nbsp;&#770;">
                  <input type="button" class="w3-button-cl" title="voiceless" onclick="alpha('&#805;')" value="&nbsp;&#805;">
                  <input type="button" class="w3-button-cl" title="breathy voiced" onclick="alpha('&#804;')" value="&nbsp;&#804;">
                  <input type="button" class="w3-button-cl" title="dental" onclick="alpha('&#810;')" value="&nbsp;&#810;">
                  <input type="button" class="w3-button-cl" title="voiced" onclick="alpha('&#812;')" value="&nbsp;&#812;">
                  <input type="button" class="w3-button-cl" title="creaky voiced" onclick="alpha('&#816;')" value="&nbsp;&#816;">
                  <input type="button" class="w3-button-cl" title="apical" onclick="alpha('&#826;')" value="&nbsp;&#826;">
                  <input type="button" class="w3-button-cl" title="linguolabial" onclick="alpha('&#828;')" value="&nbsp;&#828;">
                  <input type="button" class="w3-button-cl" title="laminal" onclick="alpha('&#827;')" value="&nbsp;&#827;">
                  <input type="button" class="w3-button-cl" title="more rounded" onclick="alpha('&#825;')" value="&nbsp;&#825;">
                  <input type="button" class="w3-button-cl" title="less rounded" onclick="alpha('&#796;')" value="&nbsp;&#796;">
                  <input type="button" class="w3-button-cl" title="advanced" onclick="alpha('&#799;')" value="&nbsp;&#799;">
                  <input type="button" class="w3-button-cl" title="retracted" onclick="alpha('&#800;')" value="&nbsp;&#800;">
                  <input type="button" class="w3-button-cl" title="raised" onclick="alpha('&#797;')" value="&nbsp;&#797;">
                  <input type="button" class="w3-button-cl" title="syllabic" onclick="alpha('&#809;')" value="&nbsp;&#809;">
                  <input type="button" class="w3-button-cl" title="lowered" onclick="alpha('&#798;')" value="&nbsp;&#798;">
                  <input type="button" class="w3-button-cl" title="non-syllabic" onclick="alpha('&#815;')" value="&nbsp;&#815;">
                  <input type="button" class="w3-button-cl" title="advanced tongue root" onclick="alpha('&#792;')" value="&nbsp;&#792;">
                  <input type="button" class="w3-button-cl" title="retracted tongue root" onclick="alpha('&#793)" value="&nbsp;&#793;">
               </div>
            </div>
         </div>
      </div>
    <?php } else {
        // If the next entry was not found, output a message
        echo "<h2><i>No more entries in this wordlist.</i></h2>";
        echo "<h4>Be patient, we are redirecting you back to your project at the moment.</h4>";
        header("refresh:5;url=project-home.php?project_id=".urlencode($projectID));
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