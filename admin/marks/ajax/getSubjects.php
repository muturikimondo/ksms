<?php
header('Content-Type: application/json');
require_once '../../includes/db/config.php'; // Include your database connection

$class_entered = $_GET['class_entered'];
// Example query to get subjects based on class
$query = "SELECT DISTINCT subject_entered as id FROM exam_subject_scores WHERE class_entered = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $class_entered);
$stmt->execute();
$result = $stmt->get_result();

$subjects = [];
while ($row = $result->fetch_assoc()) {
    $subjects[] = ['id' => $row['id'], 'name' => $row['id']]; // Assuming 'id' and 'name' are the same for simplicity
}

echo json_encode(['subjects' => $subjects]);
$conn->close();
?>
