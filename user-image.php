<?php
session_start();
include_once 'db_connection.php';

$target_dir = "images/user/";

if (isset($_POST['submit']) && isset($_FILES['user-image'])) {
    if (!empty($_FILES["user-image"]["name"])) {
        $fileName = basename($_FILES["user-image"]["name"]);
        $targetFilePath = $target_dir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $userID = $_SESSION['user-id'];
        
        // Allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server
            if (move_uploaded_file($_FILES["user-image"]["tmp_name"], $targetFilePath)) {
                // Insert image file name into database
                $insert = $mysqli->query("UPDATE user SET `user-image` = '".$fileName."' WHERE `user-id` = '".$userID."'");
                if ($insert) {
                    $_SESSION['statusMsgGreen'] = "The file " . $fileName . " has been uploaded as your new profile image.";
                    header("Location: setting.php");
                    exit();
                } else {
                    $_SESSION['statusMsg'] = "File upload failed, please try again.";
                    header("Location: setting.php");
                    exit();
                }
            } else {
                $_SESSION['statusMsg'] = "Sorry, there was an error uploading your file.";
                header("Location: setting.php");
                exit();
            }
        } else {
            $_SESSION['statusMsg'] = 'Sorry, only JPG, JPEG, and PNG files are allowed to upload.';
            header("Location: setting.php");
            exit();
        }
    } else {
        $_SESSION['statusMsg'] = 'Please choose a file before clicking submit.';
        header("Location: setting.php");
        exit();
    }
}
?>
