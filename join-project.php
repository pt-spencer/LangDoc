<?php
session_start();

require_once 'db_connection.php';

    if (isset($_POST['submit'])) {
        $projectID = $_POST['project-code'];
        // Check if the project exists
        $stmt = $mysqli->prepare("SELECT COUNT(*) FROM project WHERE `project-no` = ?");
        $stmt->bind_param("s", $projectID);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        if ($result['COUNT(*)'] == 0) {
            $message = "No project found with ID $projectID";
            header("Location: project.php?message=$message");
        } else {
            // Insert the project assignment
            $userID = $_SESSION['user-id'];
            $stmt = $mysqli->prepare("INSERT INTO `project-assignment` (`user-id`, `project-id`) VALUES (?, ?)");
            $stmt->bind_param("ss", $userID, $projectID);
            if ($stmt->execute()) {
                $message = "Successfully joined the project";
                header("Location: project.php?message=$message");
            } else {
                $message = "Failed to join project $projectID";
                header("Location: project.php?message=$message");
            }
        }
    }
    ?>