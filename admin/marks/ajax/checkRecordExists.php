<?php
include '../../includes/db/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve data from POST request
    $examination = $_POST['examination'];
    $class_entered = $_POST['class_entered'];
    $subject_entered = $_POST['subject_entered'];
    $Student_regno = $_POST['Student_regno'];

    // Check if record exists
    $checkStmt = $conn->prepare("SELECT COUNT(*) FROM exam_subject_scores WHERE examination = ? AND class_entered = ? AND subject_entered = ? AND Student_regno = ?");
    $checkStmt->bind_param("ssss", $examination, $class_entered, $subject_entered, $Student_regno);
    $checkStmt->execute();
    $checkStmt->bind_result($count);
    $checkStmt->fetch();

    echo json_encode(['exists' => $count > 0]);

    $checkStmt->close();
    $conn->close();
}
?>
