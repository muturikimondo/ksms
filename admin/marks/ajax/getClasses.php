<?php
include '../../includes/db/config.php';

$stmt = $conn->query("SELECT id, name FROM classes"); // Adjust the query as needed
$classes = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(['classes' => $classes]);
?>
