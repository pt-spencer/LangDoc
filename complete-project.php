<?php

session_start(); // Start the session

$mysqli = require __DIR__ . '/db_connection.php';

require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userID = $_SESSION['user-id'];
    $projectID = $_GET['project_id'];

    $stmt = $mysqli->prepare("INSERT INTO `project-assignment` (`user-id`, `project-id`, `role`) VALUES (?, ?, ?)");
    $role = 'admin'; // Assuming 'admin' is the role for the current user
    $stmt->bind_param('iis', $userID, $projectID, $role);
    
    if ($stmt->execute()) {
        $message = "Successfully create the project";
        header("Location: project.php");
        exit; // Add exit to stop further execution after redirect
    } else {
        echo "Failed to add the current user";
    }
} else {
    echo "Failed to add member";
}

?>
