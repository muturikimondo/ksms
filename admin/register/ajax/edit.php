<?php
// Include the database connection
require_once '../../includes/db/config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $date_of_birth = $_POST['date_of_birth'];
    $date_of_admission= $_POST['date_of_admission'];
    $gender = $_POST['gender'];
    $county = $_POST['county'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    
    // Check if an upload photo was provided
    if (isset($_FILES['upload_photo']) && $_FILES['upload_photo']['error'] === UPLOAD_ERR_OK) {
        // Handle file upload
        $upload_photo = $_FILES['upload_photo']['name'];
        // Move uploaded file to the uploads directory
        move_uploaded_file($_FILES['upload_photo']['tmp_name'], "uploads/" . $upload_photo);
    } else {
        // If no new photo is uploaded, keep the existing one
        $upload_photo = $_POST['existing_photo'];
    }

    // Prepare the SQL statement to update the record
    $stmt = $conn->prepare("UPDATE biodata SET name=?, date_of_birth=?, date_of_admission=?, gender=?, county=?, phone=?, email=?, upload_photo=? WHERE id=?");
    $stmt->bind_param("ssssssssi", $name, $date_of_birth, $date_of_admission, $gender, $county, $phone, $email, $upload_photo, $id);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
