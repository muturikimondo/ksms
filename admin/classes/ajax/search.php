<?php
include '../../includes/db/config.php';

$query = '';
if (isset($_POST['query'])) {
    $query = $_POST['query'];
}

$sql = "SELECT * FROM classes WHERE class_name LIKE '%$query%' OR stream LIKE '%$query%' ORDER BY id DESC";
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
                        
                     ' . $row['class_level'] . '
                    </div>
                    <div class="col-md-3">
                         ' . $row['stream'] . '
                    </div>
                    <div class="col-md-3">
                         ' . $row['class_name'] . '
                    </div>
                    <div class="col-md-3">
                         <div class="row">
                        <div class="col-md-6">
                        <button class="custom-button btn-sm edit-btn" data-id="' . $row['id'] . '">Edit</button>
                        </div>
                        <div class="col-md-6">
                        <button class="custom-button btn-sm delete-btn" data-id="' . $row['id'] . '">Delete</button>
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
