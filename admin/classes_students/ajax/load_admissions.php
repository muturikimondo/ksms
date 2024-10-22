<?php
require_once '../../includes/db/config.php';

// Fetch search input
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$className = isset($_GET['className']) ? mysqli_real_escape_string($conn, $_GET['className']) : '';

// Build the query
$query = "SELECT * FROM students_admission WHERE (admission_number LIKE '%$search%' OR student_email LIKE '%$search%')";

// Filter by class if a class is selected
if (!empty($className)) {
    $query .= " AND class_admitted = '$className'";
}

$result = mysqli_query($conn, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>
            <td>' . htmlspecialchars($row['admission_number']) . '</td>
            <td>' . htmlspecialchars($row['student_email']) . '</td>
            <td>' . htmlspecialchars($row['class_admitted']) . '</td>
            <td>
                <button class="btn btn-warning update-btn" data-id="' . $row['id'] . '">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn btn-danger delete-btn" data-id="' . $row['id'] . '">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        </tr>';
    }
} else {
    echo "<tr><td colspan='4'>No records found</td></tr>";
}
?>
