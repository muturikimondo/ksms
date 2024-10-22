<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection
require_once '../../includes/db/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = $_POST['name'];
    $date_of_birth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $county = $_POST['county'];
    $date_of_admission = $_POST['date_of_admission'];
    $home_address = $_POST['home_address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $category = $_POST['category'];

    // Handle file upload
    $upload_photo = '';
    if (isset($_FILES['upload_photo']) && $_FILES['upload_photo']['error'] === UPLOAD_ERR_OK) {
        $upload_photo = basename($_FILES['upload_photo']['name']);
        if (move_uploaded_file($_FILES['upload_photo']['tmp_name'], "../uploads/" . $upload_photo)) {
            // File uploaded successfully
        } else {
            echo "Error uploading file.";
            exit;
        }
    } else {
        echo "No file uploaded or there was an upload error.";
        exit;
    }

    // Insert record into the database
    $stmt = $conn->prepare("INSERT INTO biodata (name, date_of_birth, date_of_admission, gender, county, home_address, phone, email, upload_photo, category) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $name, $date_of_birth, $date_of_admission, $gender, $county, $home_address, $phone, $email, $upload_photo, $category);
    
    if ($stmt->execute()) {
        echo "Record added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
