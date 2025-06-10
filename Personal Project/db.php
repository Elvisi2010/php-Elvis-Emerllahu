<?php
$host = "localhost";
$user = "root";
$pass = ""; // your MySQL password
$db = "dbelvis1";

$conn = new mysqli($host, $user, $pass, $db);  // Use mysqli

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
