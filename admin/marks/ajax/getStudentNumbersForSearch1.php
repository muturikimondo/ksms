<?php
include '../../includes/db/config.php';

$class_entered = $_GET['class_entered'];

$stmt = $conn->prepare("SELECT id, Student_regno FROM exam_subject_scores WHERE class_entered = ? GROUP BY Student_regno");
$stmt->execute([$class_entered]);
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(['students' => $students]);
?>
