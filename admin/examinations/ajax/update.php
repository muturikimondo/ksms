<?php
include '../../includes/db/config.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $exam_type = $_POST['exam_type'];
    $exam_month = $_POST['exam_month'];
    $exam_year = $_POST['exam_year'];
    $exam_name = $exam_type . " - " . $exam_month . " " . $exam_year;

    // Prepare and execute update query
    $stmt = $conn->prepare("UPDATE examinations SET exam_type = ?, exam_month = ?, exam_year = ?, exam_name = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $exam_type, $exam_month, $exam_year, $exam_name, $id);
    
    if ($stmt->execute()) {
        header('Location: ../index.php'); // Redirect to the main page
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    
    $stmt->close();
} else {
    echo "Invalid request method.";
}
?>
