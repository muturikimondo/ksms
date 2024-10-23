<?php
// Start session only if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in and has admin rights
if (!isset($_SESSION['logged_in']) || $_SESSION['user_category'] !== 'admin') {
    // Redirect to the login page if not logged in or not an admin
    header("Location: ../index.php");
    exit();
}
?>
