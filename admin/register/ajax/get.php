<?php
require_once '../../includes/db/config.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Fetch record
    $stmt = $conn->prepare("SELECT * FROM biodata WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode([]);
    }

    $stmt->close();
}
$conn->close();
?>
