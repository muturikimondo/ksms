<?php
include '../../includes/db/config.php';

$id = $_POST['id'];




$query = "DELETE FROM subjects WHERE id = $id";
if (mysqli_query($conn, $query)) {
    echo 'success';
} else {
    echo 'error';
}
?>