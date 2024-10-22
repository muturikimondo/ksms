<?php
include '../../includes/db/config.php';

// Set the header to JSON
header('Content-Type: application/json');

// Retrieve the search query
$searchTerm = isset($_GET['term']) ? $_GET['term'] : '';

// Prepare the SQL query to fetch emails
$query = "SELECT email FROM biodata WHERE email LIKE ?";
$stmt = $conn->prepare($query);
$searchTerm = '%' . $searchTerm . '%'; // Add wildcards for partial match
$stmt->bind_param('s', $searchTerm);
$stmt->execute();

$result = $stmt->get_result();
$emails = [];

// Fetch all results and prepare them for Select2
while ($row = $result->fetch_assoc()) {
    $emails[] = [
        'id' => $row['email'],
        'text' => $row['email']
    ];
}

// Output the results in JSON format
echo json_encode($emails);

$stmt->close();
$conn->close();
?>
