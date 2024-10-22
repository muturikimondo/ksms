<?php
include '../../includes/db/config.php';

$response = [
    'examinations' => [],
    'classes' => [],
    'subjects' => []
];

// Fetch examinations
$query = "SELECT DISTINCT exam_name FROM examinations"; // Fetch distinct exam names
$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
    $response['examinations'][] = ['id' => $row['exam_name'], 'name' => $row['exam_name']];
}

// Fetch classes
$query = "SELECT DISTINCT class_admitted FROM students_admission"; // Fetch distinct classes
$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
    $response['classes'][] = ['id' => $row['class_admitted'], 'name' => $row['class_admitted']];
}

// Fetch subjects
$query = "SELECT id, name FROM subjects"; // Fetch subject id and name
$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
    $response['subjects'][] = ['id' => $row['id'], 'name' => $row['name']];
}

header('Content-Type: application/json');
echo json_encode($response);
$conn->close();
?>
