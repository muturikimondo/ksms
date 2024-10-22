<?php
header('Content-Type: application/json');
require_once '../../includes/db/config.php'; // Include your database connection

$examination = $_POST['examination'];
$class_entered = $_POST['class_entered'];
$subject_entered = $_POST['subject_entered'];
$Student_regno = $_POST['Student_regno'];
$student_marks = $_POST['student_marks'];
$id = isset($_POST['id']) ? intval($_POST['id']) : null; // ID for update

if ($id) {
    // Update existing record
    $query = "UPDATE exam_subject_scores SET examination=?, class_entered=?, subject_entered=?, Student_regno=?, student_marks=? WHERE id=?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param('ssssii', $examination, $class_entered, $subject_entered, $Student_regno, $student_marks, $id);
    } else {
        echo json_encode(['error' => 'Failed to prepare statement: ' . $conn->error]);
        exit;
    }
} else {
    // Insert new record
    $query = "INSERT INTO exam_subject_scores (examination, class_entered, subject_entered, Student_regno, student_marks) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param('ssssi', $examination, $class_entered, $subject_entered, $Student_regno, $student_marks);
    } else {
        echo json_encode(['error' => 'Failed to prepare statement: ' . $conn->error]);
        exit;
    }
}

if ($stmt->execute()) {
    echo json_encode(['message' => 'Record saved successfully']);
} else {
    echo json_encode(['error' => 'Failed to save record: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
