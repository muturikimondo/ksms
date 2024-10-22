<?php
require_once '../../includes/db/config.php';

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $query = "SELECT * FROM students_admission WHERE id = $id";
    $result = mysqli_query($conn, $query);
    
    if ($row = mysqli_fetch_assoc($result)) {
        echo json_encode($row);
    } else {
        echo "Error fetching admission data.";
    }
}
?>
