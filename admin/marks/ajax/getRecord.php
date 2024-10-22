<?php
include '../../includes/db/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Check if all required fields are provided
    if (!isset($_GET['examination']) || !isset($_GET['class_entered']) || 
        !isset($_GET['subject_entered']) || !isset($_GET['Student_regno'])) {
        echo json_encode(['success' => false, 'message' => 'All fields are required']);
        exit;
    }

    $examination = $_GET['examination'];
    $class_entered = $_GET['class_entered'];
    $subject_entered = $_GET['subject_entered'];
    $Student_regno = $_GET['Student_regno'];

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("SELECT * FROM exam_subject_scores WHERE 
                             examination = ? AND class_entered = ? AND 
                             subject_entered = ? AND Student_regno = ?");
    $stmt->bind_param("ssss", $examination, $class_entered, $subject_entered, $Student_regno);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $record = $result->fetch_assoc();
        echo json_encode(['success' => true, 'record' => $record]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Record not found']);
    }

    $stmt->close();
    $conn->close();
}
?>
