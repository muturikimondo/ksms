<?php
header('Content-Type: application/json');
require_once '../../includes/db/config.php'; // Include your database connection

$class_entered = isset($_GET['class_entered']) ? $conn->real_escape_string($_GET['class_entered']) : '';
$Student_regno = isset($_GET['Student_regno']) ? $conn->real_escape_string($_GET['Student_regno']) : '';
$subject_entered = isset($_GET['subject_entered']) ? $conn->real_escape_string($_GET['subject_entered']) : '';

// Base query
$query = "SELECT examination, class_entered, subject_entered, Student_regno, student_marks, date_entered 
          FROM exam_subject_scores WHERE 1=1";

// Append conditions based on search parameters
if ($class_entered) {
    $query .= " AND class_entered = '$class_entered'";
}
if ($Student_regno) {
    $query .= " AND Student_regno = '$Student_regno'";
}
if ($subject_entered) {
    $query .= " AND subject_entered = '$subject_entered'";
}

$result = $conn->query($query);

$records = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $records[] = $row;
    }
}

echo json_encode(['records' => $records]);
$conn->close();
?>
