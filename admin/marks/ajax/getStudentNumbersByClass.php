<?php
include '../../includes/db/config.php';

$response = ['students' => []];

if (isset($_GET['class_entered'])) {
    $classEntered = $_GET['class_entered'];

    // Prepare the query
    $query = "SELECT admission_number FROM students_admission WHERE class_admitted = ?";
    $stmt = $conn->prepare($query);
    
    if ($stmt) {
        $stmt->bind_param("s", $classEntered);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $response['students'][] = ['id' => $row['admission_number'], 'name' => $row['admission_number']];
        }

        $stmt->close(); // Close statement if it was created successfully
    } else {
        $response['error'] = 'Failed to prepare the SQL statement.';
    }
} else {
    $response['error'] = 'class_entered parameter is missing.';
}

header('Content-Type: application/json');
echo json_encode($response);
$conn->close(); // Always close the connection
?>
