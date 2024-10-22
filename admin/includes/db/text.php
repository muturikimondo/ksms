<?php
// Include the database connection parameters
require_once '../../includes/db/config.php'; // Adjust the path as necessary

// Check if the connection is successful
if ($conn->connect_error) {
    $response = 'Connection failed: ' . $conn->connect_error;
    echo "<script>alert('$response');</script>";
} else {
    $response = 'Successful Connection';
    echo "<script>alert('$response');</script>";
}

// Get versions
$mysql_version = $conn->server_info;
$php_version = phpversion();
$apache_version = $_SERVER['SERVER_SOFTWARE'];

// Display the versions
echo "<p>MySQL Version: $mysql_version</p>";
echo "<p>PHP Version: $php_version</p>";
echo "<p>Apache Version: $apache_version</p>";

// Close the connection
$conn->close();
?>
