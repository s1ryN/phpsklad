<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jakubsvoboda";

$conn = new mysqli($servername, $username, $password, $dbname);

session_start();

if ($conn->connect_error) {
    die("Spojení selhalo: " . $conn->connect_error);
}
?>
