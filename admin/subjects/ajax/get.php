<?php
include '../../includes/db/config.php';

$id = $_POST['id'];

$query = "SELECT * FROM subjects WHERE id = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
echo json_encode($row);
?>
