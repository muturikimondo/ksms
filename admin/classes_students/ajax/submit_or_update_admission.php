<?php
require_once '../../includes/db/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : null;
    $adm_no = mysqli_real_escape_string($conn, $_POST['admission_number']);
    $email = mysqli_real_escape_string($conn, $_POST['student_email']);
    $class = mysqli_real_escape_string($conn, $_POST['class_admitted']);

    if ($id) {
        // Update existing record
        $query = "UPDATE students_admission SET admission_number='$adm_no', student_email='$email', class_admitted='$class' WHERE id=$id";
        if (mysqli_query($conn, $query)) {
            echo "Record updated successfully!";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        // Insert new record
        $query = "INSERT INTO students_admission (admission_number, student_email, class_admitted) VALUES ('$adm_no', '$email', '$class')";
        if (mysqli_query($conn, $query)) {
            echo "Admission record added successfully!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>
