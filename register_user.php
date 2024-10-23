<?php
// File: register_user.php
require 'admin/includes/db/config.php';  // Ensure the path to config.php is correct

// Check if form data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $category = $_POST['category'];

    // Check if all fields are filled
    if (!empty($name) && !empty($email) && !empty($password) && !empty($category)) {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the SQL query
        $query = "INSERT INTO users (name, email, password, category) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("ssss", $name, $email, $hashed_password, $category);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>User registered successfully!</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
            }

            $stmt->close();
        } else {
            echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Please fill all fields!</div>";
    }
} else {
    echo "<div class='alert alert-danger'>Invalid request method.</div>";
}

$conn->close();
?>
