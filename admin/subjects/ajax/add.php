<?php
include '../../includes/db/config.php';

$code = $_POST['code'];
$name = $_POST['name'];
$category = $_POST['category'];




$query = "INSERT INTO subjects (code, name, subject_group) VALUES ('$code', '$name', '$category')";
if (mysqli_query($conn, $query)) {
    echo 'success';
} else {
    echo 'error';
}
?>
