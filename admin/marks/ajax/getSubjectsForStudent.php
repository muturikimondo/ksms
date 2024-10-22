<?php
include '../../includes/db/config.php';

$student_regno = $_GET['student_regno'];

$stmt = $conn->prepare("SELECT DISTINCT subject_entered AS name FROM exam_subject_scores WHERE Student_regno = ?");
$stmt->execute([$student_regno]);
$subjects = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(['subjects' => $subjects]);
?>
