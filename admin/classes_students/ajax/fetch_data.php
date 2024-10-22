<?php
// Include the database connection file
require_once '../../includes/db/config.php';

// Check for the AJAX request type
if (isset($_POST['type'])) {
    $type = $_POST['type'];
    
    if ($type == 'email') {
        $query = "SELECT DISTINCT email FROM biodata";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo '<option value="">Select Email</option>';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . htmlspecialchars($row['email']) . '">' . htmlspecialchars($row['email']) . '</option>';
            }
        }
    }

    if ($type == 'class') {
        $query = "SELECT DISTINCT class_name FROM classes";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo '<option value="">Select Class</option>';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . htmlspecialchars($row['class_name']) . '">' . htmlspecialchars($row['class_name']) . '</option>';
            }
        }
    }
}
?>
