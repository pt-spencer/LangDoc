<?php
// Check if the user is not authenticated
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: index.php'); // Redirect to the login page
    exit;
}
?>
