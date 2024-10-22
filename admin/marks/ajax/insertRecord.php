<?php
include '../../includes/db/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve data from the POST request
    $examination = $_POST['examination'];
    $class_entered = $_POST['class_entered'];
    $subject_entered = $_POST['subject_entered'];
    $Student_regno = $_POST['Student_regno'];
    $student_marks = $_POST['student_marks'];

    // Check if the record already exists
    $stmt = $conn->prepare("SELECT * FROM exam_subject_scores WHERE examination = ? AND class_entered = ? AND subject_entered = ? AND Student_regno = ?");
    $stmt->bind_param("ssss", $examination, $class_entered, $subject_entered, $Student_regno);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(['message' => 'Error inserting record: Duplicate entry']);
    } else {
        // Insert new record
        $insertStmt = $conn->prepare("INSERT INTO exam_subject_scores (examination, class_entered, subject_entered, Student_regno, student_marks) VALUES (?, ?, ?, ?, ?)");
        $insertStmt->bind_param("sssss", $examination, $class_entered, $subject_entered, $Student_regno, $student_marks);
        $insertStmt->execute();

        if ($insertStmt->affected_rows > 0) {
            echo json_encode(['message' => 'Record inserted successfully']);
        } else {
            echo json_encode(['message' => 'Insert failed']);
        }
        $insertStmt->close();
    }

    $stmt->close();
    $conn->close();
}
?>
