<?php
require_once 'db_connection2.php';

if (isset($_POST['submit'])) {
    $wordlistName = $_POST['wordlist-name'];
    $projectID = $_GET['project_id'];
    $wordlist = $_POST['wordlist'];
    $stmt = $mysqli->prepare("INSERT INTO wordlist (`project-id`, `wordlist-name`) VALUES (?, ?)");
    $stmt->bind_param("ss",
                        $projectID, 
                        $wordlistName);
    if (!$stmt->execute()) {
        die("SQL ERROR! Failed to execute statement: " . $stmt->error);
    }

    $stmt = $mysqli->prepare("SELECT `wordlist-id` FROM `wordlist` WHERE `project-id` = ? AND `wordlist-name` = ?");
    $stmt->bind_param("ss",
                        $projectID, 
                        $wordlistName);
    $stmt->execute();
    $wordlistID = $stmt->get_result()->fetch_assoc()['wordlist-id'];
    

    switch ($wordlist) {
        case 'asjp40':
            $sqlFile = 'wordlist/asjp40.sql';
            break;
        case 'dp15':
            $sqlFile = 'wordlist/dp15.sql';
            break;
        case 'ngsl':
            $sqlFile = 'wordlist/ngsl.sql';
            break;
        case 'sw100':
            $sqlFile = 'wordlist/sw100.sql';
            break;
        case 'sw207':
            $sqlFile = 'wordlist/sw207.sql';
            break;
        case 'sw-yt35':
            $sqlFile = 'wordlist/sw-yt35.sql';
            break;
        case 'sgn':
            $sqlFile = 'wordlist/sgn.sql';
            break;
    }

    
    if (isset($sqlFile)) {
        $sqlContent = file_get_contents($sqlFile);
    
        // Replace the placeholders in the SQL file with the actual values
        $sqlContent = str_replace('?', $wordlistID, $sqlContent);
    
        if ($mysqli->multi_query($sqlContent)) {
            $projectID = $_GET['project_id'];
            header("Location: add-member.php?project_id=$projectID");
            exit;
        } else {
            echo "Error executing {$wordlist}.sql file: " . $mysqli->error;
        }
    }
    else {
        header("Location: add-member.php?project_id=$projectID");
    }


    // Redirect to the desired page after successful submission
    //header("Location: add-member.php");
    //exit;
}
?>