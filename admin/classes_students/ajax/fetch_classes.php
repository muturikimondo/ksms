<?php
require_once '../../includes/db/config.php';

$sql = "SELECT class_name FROM classes";
$result = $conn->query($sql);

$classes = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $classes[] = $row['class_name'];  // Collect class names in an array
    }
}
echo json_encode($classes);  // Output as JSON
$conn->close();
?>
