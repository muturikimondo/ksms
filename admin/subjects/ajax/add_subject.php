<?php
include '../../includes/db/config.php';

$code = $_POST['code'];
$name = $_POST['name'];
$subject_group = $_POST['category'];

$sql = "INSERT INTO subjects (code, name, subject_group) VALUES ('$code', '$name', '$subject_group')";
$conn->query($sql);
?>
