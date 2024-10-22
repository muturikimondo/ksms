<?php
// Include the database connection file
require_once '../../includes/db/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adm_no = mysqli_real_escape_string($conn, $_POST['adm_no']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $class = mysqli_real_escape_string($conn, $_POST['class']);

    $query = "INSERT INTO students_admission (admission_number, student_email, class_admitted) VALUES ('$adm_no', '$email', '$class')";
    
    if (mysqli_query($conn, $query)) {
        echo "Admission record added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
