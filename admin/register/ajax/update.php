<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection
require_once '../../includes/db/config.php';

// Initialize response array
$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $date_of_birth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $county = $_POST['county'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // Initialize variable for the photo
    $upload_photo = '';

    // Check if a new file was uploaded
    if (isset($_FILES['upload_photo']) && $_FILES['upload_photo']['error'] === UPLOAD_ERR_OK) {
        // Get the existing photo name from the database
        $stmt = $conn->prepare("SELECT upload_photo FROM biodata WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $existing_photo = $row['upload_photo'];
            
            // Delete the old photo if necessary
            if (!empty($existing_photo) && file_exists("uploads/" . $existing_photo)) {
                unlink("uploads/" . $existing_photo);
            }
        }

        // Handle the new photo upload
        $upload_photo = basename($_FILES['upload_photo']['name']);
        move_uploaded_file($_FILES['upload_photo']['tmp_name'], "uploads/" . $upload_photo);
    }

    // Prepare SQL statement to update the record
    if ($upload_photo) {
        $stmt = $conn->prepare("UPDATE biodata SET name=?, date_of_birth=?, gender=?, county=?, phone=?, email=?, upload_photo=? WHERE id=?");
        $stmt->bind_param("sssssssi", $name, $date_of_birth, $gender, $county, $phone, $email, $upload_photo, $id);
    } else {
        $stmt = $conn->prepare("UPDATE biodata SET name=?, date_of_birth=?, gender=?, county=?, phone=?, email=? WHERE id=?");
        $stmt->bind_param("ssssssi", $name, $date_of_birth, $gender, $county, $phone, $email, $id);
    }

    // Execute the statement and check for success
    if ($stmt->execute()) {
        $response['status'] = 'success';
        $response['message'] = "Record updated successfully.";
    } else {
        $response['status'] = 'error';
        $response['message'] = "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
