<?php
include '../../includes/db/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Delete query
    $sql = "DELETE FROM examinations WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
