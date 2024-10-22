<?php
include '../../includes/db/config.php'; // Ensure the path is correct

$classAdmitted = isset($_GET['class_admitted']) ? $_GET['class_admitted'] : null;
$studentNumber = isset($_GET['student_number']) ? $_GET['student_number'] : null;
$subject = isset($_GET['subject']) ? $_GET['subject'] : null;

$response = ['data' => []];

$sql = "SELECT * FROM exam_subject_scores WHERE 1=1";
$params = [];
$types = '';

if ($classAdmitted) {
    $sql .= " AND class_entered = ?";
    $params[] = $classAdmitted;
    $types .= 's'; // Assuming class_entered is a string
}
if ($studentNumber) {
    $sql .= " AND Student_regno = ?";
    $params[] = $studentNumber;
    $types .= 's'; // Assuming Student_regno is a string
}
if ($subject) {
    $sql .= " AND subject_entered = ?";
    $params[] = $subject;
    $types .= 's'; // Assuming subject_entered is a string
}

// Prepare and execute the query
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    echo "Prepare failed: " . $conn->error;
    exit;
}

if ($params) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();

$result = $stmt->get_result();

if ($result === false) {
    echo "Query failed: " . $stmt->error;
    exit;
}

while ($row = $result->fetch_assoc()) {
    $response['data'][] = $row;
}

echo json_encode($response);

// Close statement and connection
$stmt->close();
$conn->close();
?>
