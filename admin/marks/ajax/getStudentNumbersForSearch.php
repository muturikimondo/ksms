<?php
include '../../includes/db/config.php';

$class_entered = $_GET['class_entered'] ?? '';
$students = [];

// Query to fetch student admission numbers based on class
if ($class_entered) {
    $stmt = $conn->prepare("SELECT DISTINCT Student_regno FROM exam_subject_scores WHERE class_entered = ?");
    $stmt->bind_param("s", $class_entered);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $students[] = ['id' => $row['Student_regno'], 'name' => $row['Student_regno']];
    }

    echo json_encode(['students' => $students]);
} else {
    echo json_encode(['students' => []]);
}

$stmt->close();
$conn->close();
?>
