<?php
include '../../includes/db/config.php';

$id = $_POST['id'];
$code = $_POST['code'];
$name = $_POST['name'];
$category = $_POST['category'];





$query = "UPDATE subjects SET name='$name', code='$code', subject_group='$category' WHERE id=$id";
if (mysqli_query($conn, $query)) {
    echo 'success';
} else {
    echo 'error';
}
?>
