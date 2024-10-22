<?php
include '../../includes/db/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $exam_type = $_POST['exam_type'];
    $exam_month = $_POST['exam_month'];
    $exam_year = $_POST['exam_year'];

    // Generate the exam_name (must be unique)
    $exam_name = $exam_type . " - " . $exam_month . " " . $exam_year;

    // Check if the exam_name already exists
    $check_query = $conn->query("SELECT * FROM examinations WHERE exam_name = '$exam_name'");
    if ($check_query->num_rows > 0) {
        echo "Examination already exists!";
    } else {
        // Insert the examination into the database
        $sql = "INSERT INTO examinations (exam_type, exam_month, exam_year, exam_name)
                VALUES ('$exam_type', '$exam_month', '$exam_year', '$exam_name')";

        if ($conn->query($sql) === TRUE) {
            header("Location: ../index.php"); // Redirect to index.php after successful insert
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
