<?php
include '../../includes/db/config.php';

$query = '';
if (isset($_POST['query'])) {
    $query = $_POST['query'];
}

$sql = "SELECT * FROM biodata WHERE name LIKE '%$query%' OR email LIKE '%$query%' ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
$output = '';

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= '
        <!--div class="card mb-3 p-4" -->
            <div class="card-elevated p-5">
                <div class="row">
                    <div class="col-12 text-center">

                    <div class="round-card"><img src="uploads/' . $row['upload_photo'] . '" alt="Photo"></div>
                        
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12"><hr></div>  
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Name:</strong> ' . $row['name'] . '
                    </div>
                    <div class="col-md-6">
                        <strong>Date of Birth:</strong> ' . $row['date_of_birth'] . '
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-12"><hr></div>  
                </div>


                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>County:</strong> ' . $row['county'] . '
                    </div>
                    <div class="col-md-4">
                        <strong>Gender:</strong> ' . $row['gender'] . '
                    </div>
                    <div class="col-md-4">
                        <strong>Phone:</strong> ' . $row['phone'] . '
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12"><hr></div>  
                </div>

                <div class="row mb-3">
                    <div class="col-md-8">
                        <strong>Date of Admission:</strong> ' . $row['date_of_admission'] . '
                    </div>
                    <div class="col-md-4">
                        <strong>Email:</strong> ' . $row['email'] . '
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12"><hr></div>  
                </div>


                <div class="row mb-3">
                    <div class="col-md-8">
                        <strong>Home Address:</strong> ' . $row['home_address'] . '
                    </div>
                    <div class="col-md-4">
                        <strong>User Category:</strong> ' . $row['category'] . '
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12"><hr></div>  
                </div>

                <div class="row mt-3 mb-3">
                    <div class="col-md-12 text-center">
                        <button class="custom-button btn-sm edit-btn" data-id="' . $row['id'] . '">Edit</button>
                        <button class="custom-button btn-sm delete-btn" data-id="' . $row['id'] . '">Delete</button>
                    </div>
                </div>
            </div>
        <!--/div -->
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
