<?php
$servername = "localhost";
$username = "root";
$password = "254KeNYA&&!!";
$dbname = "smsweb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
