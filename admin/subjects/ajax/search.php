<?php
include '../../includes/db/config.php';

$query = '';
if (isset($_POST['query'])) {
    $query = $_POST['query'];
}

$sql = "SELECT * FROM subjects WHERE name LIKE '%$query%' OR code LIKE '%$query%' ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
$output = '';

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= '
        
                
                    
                
                <div class="row">
                    <div class="col-12"><hr></div>  
                </div>

                <div class="row">
                    <div class="col-md-3">
                        
                     ' . $row['code'] . '
                    </div>
                    <div class="col-md-3">
                         ' . $row['name'] . '
                    </div>
                    <div class="col-md-3">
                         ' . $row['subject_group'] . '
                    </div>
                    <div class="col-md-3">
                         <div class="col-md-12 text-center">
                        <button class="custom-button btn-sm edit-btn" data-id="' . $row['id'] . '">Edit</button>
                        <button class="custom-button btn-sm delete-btn" data-id="' . $row['id'] . '">Delete</button>
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
