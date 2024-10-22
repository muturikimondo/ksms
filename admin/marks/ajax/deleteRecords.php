<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include database configuration
require_once '../../includes/db/config.php'; // Ensure this path is correct

// Get data from POST request
$examination = isset($_POST['examination']) ? $_POST['examination'] : '';
$class_entered = isset($_POST['class_entered']) ? $_POST['class_entered'] : '';
$subject_entered = isset($_POST['subject_entered']) ? $_POST['subject_entered'] : '';
$Student_regno = isset($_POST['Student_regno']) ? $_POST['Student_regno'] : '';

// Validate required fields
if (empty($examination) || empty($class_entered) || empty($subject_entered) || empty($Student_regno)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit;
}

// Prepare SQL statement
$stmt = $conn->prepare("DELETE FROM exam_subject_scores 
                        WHERE examination = ? 
                        AND class_entered = ? 
                        AND subject_entered = ? 
                        AND Student_regno = ?");

if ($stmt) {
    // Bind parameters
    $stmt->bind_param("ssss", $examination, $class_entered, $subject_entered, $Student_regno);

    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Record deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete record']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
}

// Close the database connection
$conn->close();
?>
