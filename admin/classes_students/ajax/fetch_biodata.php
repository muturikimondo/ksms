<?php
require_once '../../includes/db/config.php';

$sql = "SELECT email FROM biodata";
$result = $conn->query($sql);

$emails = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $emails[] = $row['email'];  // Collect emails in an array
    }
}
echo json_encode($emails);  // Output as JSON
$conn->close();
?>
