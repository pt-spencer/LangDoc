<?php
//include 'auth.php';
require_once 'db_connection.php';

if (isset($_SESSION['user-id'])) {
    $mysqli = require __DIR__ . '/db_connection.php';
}

if (isset($_POST['submit'])) {
    $projectName = $_POST['project-name'];
    $projectAffiliation = $_POST['project-affiliation'];
    $projectLanguage = $_POST['project-language'];

    // Retrieve the language ID based on the language name
    $stmt = $mysqli->prepare("SELECT `language-id` FROM `language` WHERE `language-name` = ? LIMIT 1");
    $stmt->bind_param("s", $projectLanguage);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $languageId = $row['language-id'];
    $stmt->close();
    
    // Prepare and execute the SQL statement
    $stmt = $mysqli->prepare("INSERT INTO project (`project-name`, `project-affiliation`, `language-id`) VALUES (?, ?, ?)");
    $stmt->bind_param("sss",
                        $projectName, 
                        $projectAffiliation, 
                        $languageId);
    if (!$stmt->execute()) {
        die("SQL ERROR! Failed to execute statement: " . $stmt->error);
    }
    
    // Get the inserted project ID
    $stmt = $mysqli->prepare("SELECT `project-no` FROM `project` WHERE `project-name` = ? AND `project-affiliation` = ? AND `language-id` = ?");
    $stmt->bind_param("sss",
                        $projectName, 
                        $projectAffiliation, 
                        $languageId);
    $stmt->execute();
    $projectId = $stmt->get_result()->fetch_assoc()['project-no'];
    $stmt->close();
    
    // Redirect to wl-config.php with the project ID
    header("Location: wl-config.php?project_id=$projectId");
    exit;
}
?>
