<?php

$host = "localhost";
$dbname = "project";
$username = "root";
$password = "";

$mysqli = new mysqli(hostname: $host, 
                    username: $username, 
                    password: $password,
                    database: $dbname);

if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}

return $mysqli;


const DBHOST = 'localhost';
const DBUSER = 'root';
const DBPASS = '';
const DBNAME = 'project';

$dsn = 'mysql:host=' . DBHOST . ';dbname=' . DBNAME . '';
$conn = null;

try {
    $conn = new PDO($dsn, DBUSER, DBPASS);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Error : " . $e->getMessage());
}

?>