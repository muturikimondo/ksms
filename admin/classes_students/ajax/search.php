<?php
include '../../includes/db/config.php';

$query = '';
if (isset($_POST['query'])) {
    $query = $_POST['query'];
}

$sql = "SELECT * FROM students_admission WHERE student_email LIKE '%$query%' OR admission_number LIKE '%$query%' ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
$output = '';

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= '
            <div class="row">
                <div class="col-12"><hr></div>  
            </div>

            <div class="row">
                <div class="col-md-5">
                    ' . htmlspecialchars($row['student_email']) . '
                </div>
                <div class="col-md-2">
                    ' . htmlspecialchars($row['admission_number']) . '
                </div>
                <div class="col-md-2">
                    ' . htmlspecialchars($row['class_admitted']) . '
                </div>
                <div class="col-md-2">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <button class="btn btn-link p-0 update-btn" data-id="' . $row['id'] . '">
                                <i class="fas fa-edit" style="font-size: 24px;"></i>
                            </button>
                        </div>
                        <div class="col-md-6 text-center">
                            <button class="btn btn-link p-0 delete-btn" data-id="' . $row['id'] . '">
                                <i class="fas fa-trash" style="font-size: 24px;"></i>
                            </button>
                        </div>
                    </div>
                </div>   
            </div>
        ';
    }
} else {
    $output .= '
    <div class="alert alert-warning" role="alert">
        No records found
    </div>
    ';
}

echo $output;
?>
