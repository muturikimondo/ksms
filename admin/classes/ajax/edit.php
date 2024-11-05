<?php


include '../../includes/db/config.php';

$id = $_POST['id'];
$level = $_POST['class_level'];
$stream = $_POST['stream'];
$class_name = $level . ' ' . $stream;







$query = "UPDATE classes SET class_name='$class_name', class_level='$level', stream='$stream' WHERE id=$id";
if (mysqli_query($conn, $query)) {
    echo 'success';
} else {
    echo 'error';
}
?>
