<?php
require_once '../../includes/db/config.php';

$id = $_POST['id'];

$query = "SELECT * FROM students_admission WHERE id = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
echo json_encode($row);
?>
