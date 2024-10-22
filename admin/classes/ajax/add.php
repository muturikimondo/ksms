<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection
require_once '../../includes/db/config.php'; // Adjust the path as necessary

// Check if the connection was established
if (!isset($conn)) {
    die("Database connection not established.");
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve POST data
    $level = $_POST['level'];
    $stream = $_POST['stream'];

    // Generate class name
    $class_name = $level . ' ' . $stream; // Class name generated from level and stream

    // Prepare an SQL statement to insert data
    $sql = "INSERT INTO classes (class_level, stream, class_name) VALUES (?, ?, ?)";

    // Use mysqli to create a prepared statement
    if ($stmt = $conn->prepare($sql)) { // Change $mysqli to $conn
        // Bind parameters (s for string type)
        $stmt->bind_param('sss', $level, $stream, $class_name); // Bind the class name as well

        // Execute the statement
        if ($stmt->execute()) {
            echo "Class added successfully: " . htmlspecialchars($class_name);
        } else {
            echo "Error adding class: " . $stmt->error; // Show the error message
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error; // Show the error message
    }
}
?>
