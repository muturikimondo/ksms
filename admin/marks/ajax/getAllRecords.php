<?php
header('Content-Type: application/json');
require_once '../../includes/db/config.php';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10; // Records per page
$offset = ($page - 1) * $limit;

$query = "SELECT examination, class_entered, subject_entered, Student_regno, student_marks, date_entered 
          FROM exam_subject_scores LIMIT $limit OFFSET $offset";
$result = $conn->query($query);

$records = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $records[] = $row;
    }
}

// Count total records for pagination
$countQuery = "SELECT COUNT(*) as total FROM exam_subject_scores";
$countResult = $conn->query($countQuery);
$totalRecords = $countResult->fetch_assoc()['total'];

echo json_encode([
    'records' => $records,
    'total' => $totalRecords,
    'page' => $page,
    'limit' => $limit
]);

$conn->close();
?>
