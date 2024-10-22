<?php
// Include the database connection file
require_once '../../includes/db/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);

    $query = "DELETE FROM students_admission WHERE id = $id";
    
    if (mysqli_query($conn, $query)) {
        echo "Admission record deleted successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
