
<?php

include '../../includes/db/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve data from the POST request
    $examination = $_POST['examination'];
    $class_entered = $_POST['class_entered'];
    $subject_entered = $_POST['subject_entered'];
    $Student_regno = $_POST['Student_regno'];
    $student_marks = $_POST['student_marks'];

    // Prepare update statement
    $updateStmt = $conn->prepare("UPDATE exam_subject_scores SET 
        student_marks = ? 
        WHERE examination = ? AND class_entered = ? AND subject_entered = ? AND Student_regno = ?");

    // Bind parameters
    $updateStmt->bind_param("sssss", $student_marks, $examination, $class_entered, $subject_entered, $Student_regno);
    
    // Execute the statement
    if ($updateStmt->execute()) {
        if ($updateStmt->affected_rows > 0) {
            echo json_encode(['message' => 'Record updated successfully']);
        } else {
            echo json_encode(['message' => 'No changes made or record not found']);
        }
    } else {
        echo json_encode(['message' => 'Update failed: ' . $updateStmt->error]);
    }

    $updateStmt->close();
    $conn->close();
}
?>