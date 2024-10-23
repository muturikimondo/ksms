<?php
session_start();
require 'admin/includes/db/config.php';  // Ensure this path is correct

// Check if email and password are set in POST data
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];  // This is the plain password from the login form
} else {
    // Redirect back to login if no POST data
    header("Location: login.php?error=missing_data");
    exit();
}

// Check if user exists
$query = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($query);  // Ensure you're using $conn as per your config.php

if ($stmt) {
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify the plain password against the hashed password in the database
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_category'] = $user['category'];
            $_SESSION['logged_in'] = true; // Add this session variable to track if logged in

            // Debugging - Check session data
            echo "<pre>";
            print_r($_SESSION);  // For debugging purposes
            echo "</pre>";
            // exit();  // Uncomment this line if you need to see session values before redirecting

            // Redirect based on user category
            if ($user['category'] == 'admin') {
                header("Location: admin/index.php");
            } elseif ($user['category'] == 'student') {
                header("Location: students/index.php");
            } elseif ($user['category'] == 'teacher') {
                header("Location: teachers/index.php");
            } else {
                header("Location: index.php?error=unknown_user");
            }
            exit();
        } else {
            // Incorrect password
            header("Location: index.php?error=wrong_password");
            exit();
        }
    } else {
        // User does not exist
        header("Location: index.php?error=user_not_found");
        exit();
    }

    $stmt->close();
} else {
    // Database query error
    die('Database query failed: ' . $conn->error);
}

$conn->close();
?>
