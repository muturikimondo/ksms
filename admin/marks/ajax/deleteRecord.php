<?php
header('Content-Type: application/json');
require_once '../../includes/db/config.php'; // Include your database connection

if (isset($_POST['id'])) {
    $id = intval($_POST['id']); // Ensure the ID is an integer

    // Validate the ID
    if ($id <= 0) {
        echo json_encode(['message' => 'Invalid ID.']);
        exit;
    }

    // Prepare the DELETE statement
    $query = "DELETE FROM exam_subject_scores WHERE id = ?";
    $stmt = $conn->prepare($query);
    
    if ($stmt === false) {
        echo json_encode(['message' => 'Failed to prepare statement: ' . $conn->error]);
        exit;
    }

    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(['message' => 'Record deleted successfully']);
        } else {
            echo json_encode(['message' => 'No record found with that ID']);
        }
    } else {
        echo json_encode(['message' => 'Failed to delete record: ' . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['message' => 'Invalid ID']);
}

$conn->close();
?>
