<?php
include '../../includes/db/config.php'; // Adjust the path if necessary

$class = $_GET['class'] ?? '';
$studentNumber = $_GET['studentNumber'] ?? '';

// Prepare your SQL query
$query = "SELECT * FROM scores WHERE 1=1";
$params = [];

if ($class) {
    $query .= " AND class_entered = ?";
    $params[] = $class;
}

if ($studentNumber) {
    $query .= " AND Student_regno = ?";
    $params[] = $studentNumber;
}

// Prepare and execute the statement
$stmt = $pdo->prepare($query);
$stmt->execute($params);

$records = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(['records' => $records]);
?>
