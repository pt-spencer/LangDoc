<?php
require_once 'db_connection.php';
session_start(); // Start the session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mysqli = require __DIR__ . '/db_connection.php';

    if (isset($_SESSION['user-id'])) {
        $userId = $_SESSION['user-id'];

        if (isset($_POST['query'])) {
            $inputText = $_POST['query'];

            // Check if the input text has at least 3 characters
            if (strlen($inputText) >= 3) {
                $stmt = $mysqli->prepare("SELECT `user-id`, `user-name`, `user-affiliation`, `user-email` FROM `user` WHERE (`user-id` != ?) AND (`user-name` LIKE ? OR `user-email` LIKE ?)");
                $stmt->bind_param('iss', $userId, $userName, $userEmail);
                $userName = '%' . $inputText . '%';
                $userEmail = '%' . $inputText . '%';
                $stmt->execute();
                $result = $stmt->get_result();

                $condition = preg_replace('/\s+/', '', $inputText);
                $replace_string = '<b>' . $condition . '</b>';

                if ($result) {
                    $foundResults = false;
                    while ($row = $result->fetch_assoc()) {
                        $userID = $row['user-id'];
                        $userName = $row['user-name'];
                        $userAffiliation = $row['user-affiliation'];
                        $userEmail = $row['user-email'];

                        // Bold the matched text
                        $boldUserName = preg_replace('/' . preg_quote($inputText, '/') . '/i', '<b>$0</b>', $userName);

                        echo '<a class="list-group-item list-group-item-action border-1" onclick="fetchUserData(\'' . $userID . '\')">' . $boldUserName . '</a>';
                        $foundResults = true;
                    }

                    if (!$foundResults) {
                        echo '<p class="list-group-item border-1">No User Found</p>';
                    }
                } else {
                    echo '<p class="list-group-item border-1">No User Found</p>';
                }
            }
        } elseif (isset($_POST['userName']) && isset($_POST['project_id'])) {
        $userName = $_POST['userName'];
        $project_id = $_POST['project_id'];
    
        $stmt = $mysqli->prepare("SELECT `user-id`, `user-affiliation` FROM user WHERE `user-name` = ?");
        $stmt->bind_param('s', $userName);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $userID = $row['user-id'];
            $userAffiliation = $row['user-affiliation'];
    
            // Insert the user-id and project_id into the database
            $stmt = $mysqli->prepare("INSERT INTO `project-assignment` (`user-id`, `project-id`) VALUES (?, ?)");
            $stmt->bind_param('ii', $userID, $project_id);
            if ($stmt->execute()) {
                echo $userAffiliation;
            } else {
                echo "Failed to add member";
            }
        } else {
            echo "User not found";
        }
    }

    }

}
?>
