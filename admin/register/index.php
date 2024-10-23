

<?php
// File: admin/index.php

// Start session and check if user is an admin
session_start();
require '../admin_auth.php';  // Ensure this path is correct based on your file structure
?>










<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KSMS | Biodata Form</title>
    <!-- Font Awesome CSS -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--CDN FOR Bootstrap Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Favicon -->
    <link rel="icon" href="../images/branding/KS.ico" type="image/x-icon">    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../includes/css/styles.css">   
    <!-- Custom Inline Styles -->
    <style>
        .scrollable {
            height: 100vh;
            overflow-y: auto;
        }
.img-fluid {
            max-width: 100%;
            height: auto;
        }

        .round-card {
    width: 228px;
    height: 228px;
    border-radius: 50%;
    overflow: hidden;
    display: inline-block;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.1);
    border: 2px solid #ddd;
    background-color: #fff;
    padding: 10px; /* Add padding to create space around the image */
    box-sizing: border-box; /* Ensure padding is included in the total width and height */
    position: relative;
}

.round-card img {
    width: calc(100% - 20px); /* Subtract the padding to keep the image inside the container */
    height: calc(100% - 20px); /* Subtract the padding to keep the image inside the container */
    object-fit: cover;
    border-radius: 50%; /* Ensure the image itself is round */
}

.round-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    border-radius: 50%;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.2);
}

.custom-button {
    background-color: cornsilk;
    color: grey;
    border: none;
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
    font-weight: bold;
    border-radius: 25px;
    transition: background-color 0.3s ease, transform 0.3s ease;
    cursor: pointer;
    outline: none;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.custom-button:hover {
    background-color: #FFFACD;
}

.custom-button:active {
    transform: scale(0.98);
}

.custom-button:focus {
    box-shadow: 0 0 0 4px rgba(0, 123, 255, 0.25);
}



    </style>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>   
    <!-- Custom Scripts -->
    
    
    <script src="../includes/jscripts/menu-1.js"></script>
</head>
<body>
    <div class="container-fluid gradient-bg-1">
        <!-- First Row with 85% viewport width -->
        <div class="d-none d-sm-block">
            <!-- Logout Power Button in the Top Right -->
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#logoutModal" title="Logout">
                <i class="bi bi-power"></i>
            </button>
        </div>

        <h1 class="text-center mb-4">SMS-KE | Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?> (Admin)</h1>
            <div class="row mb-3 gradient-bg-1  d-none d-md-flex">
                <!--Column 2 Start Here-->
                <div class="col-sm-3">
                    <div class="card mb-3">
                    </div>
                </div>
                <!--Column 2-->
                <div class="col-sm-6">

                    <div class="row">
                        <div class="col-12 text-center">
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card mb-3">
                        <div class="row">
                            <div class="col-12 text-center">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Second Row divided into 2 columns -->
        <div class="row">
            <!--Start of column scrollable-->
            <div class="col-sm-3 scrollable">
                <div class="card mb-3">
                    <div class="card p-5"><img src="../images/branding/KS.png" alt="ksms Icon" class="icon-img">
                    </div>
                </div>
                <!-- Left column (menu and graphs) -->
                <!--END HERE-->
                
                    <div class="card-elevated p-4">
                        
                            <div class="menu-toggle-1">
                                <a href="#" class="btn btn-primary d-block d-sm-none" id="menu-toggle-1">
                                    <i class="bi bi-list"></i>
                                    <span class="visually-hidden">Toggle Menu</span>
                                </a>
                            </div>
                            <div class="menu-1">
                                <div class="menu-item-1">
                                    <a href="home.html" class="d-flex align-items-center p-2 rounded bg-light">
                                        <div class="card-elevated rounded-circle p-2 me-2"
                                            style="background-color: cornsilk;">
                                            <img src="../images/menu/home.png" alt="Home Icon"
                                                class="img-fluid rounded-circle" style="max-width: 40px;">
                                        </div>
                                        <span class="ms-2" style="font-weight: bold;">Home</span>
                                    </a>
                                </div>
                                <hr>
                                <div class="menu-item-1">
                                    <a href="home.html" class="d-flex align-items-center p-2 rounded bg-light">
                                        <div class="card-elevated rounded-circle p-2 me-2"
                                            style="background-color: cornsilk;">
                                            <img src="../images/menu/admin.png" alt="Home Icon"
                                                class="img-fluid rounded-circle" style="max-width: 40px;">
                                        </div>
                                        <span class="ms-2" style="font-weight: bold;">Administrator</span>
                                    </a>
                                </div>
                                <hr>
                                <div class="menu-item-1">
                                    <a href="home.html" class="d-flex align-items-center p-2 rounded bg-light">
                                        <div class="card-elevated rounded-circle p-2 me-2"
                                            style="background-color:cornsilk;">
                                            <img src="../images/menu/teacher.png" alt="Home Icon"
                                                class="img-fluid rounded-circle" style="max-width: 40px;">
                                        </div>
                                        <span class="ms-2" style="font-weight: bold;">Teachers</span>
                                    </a>
                                </div>
                                <hr>
                                <div class="menu-item-1">
                                    <a href="home.html" class="d-flex align-items-center p-2 rounded bg-light">
                                        <div class="card-elevated rounded-circle p-2 me-2"
                                            style="background-color: cornsilk;">
                                            <img src="../images/menu/students.png" alt="Home Icon"
                                                class="img-fluid rounded-circle" style="max-width: 40px;">
                                        </div>
                                        <span class="ms-2" style="font-weight: bold;">Students</span>
                                    </a>
                                </div>
                                <hr>
                                <div class="menu-item-1">
                                    <a href="home.html" class="d-flex align-items-center p-2 rounded bg-light">
                                        <div class="card-elevated rounded-circle p-2 me-2"
                                            style="background-color: cornsilk;">
                                            <img src="../images/menu/currency.png" alt="Home Icon"
                                                class="img-fluid rounded-circle" style="max-width: 40px;">
                                        </div>
                                        <span class="ms-2" style="font-weight: bold;">Finance</span>
                                    </a>
                                </div>
                                <hr>
                            </div>
                        
                    </div>
                
                <div class="card-elevated mb-3">
                    <div class="card text-center">
                        <canvas id="myDonutChart"></canvas>
                    </div>
                </div>
                <div class="card-elevated text-center">
                    <div class="card">
                        <canvas id="userTypeChart"></canvas>
                    </div>
                </div>
            </div>
            <!--End of Scrollable Column-->
            <div class="col-sm-6 scrollable">
                <!-- Right column (forms and table) -->
                <div class="card p-5 mb-3">
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <div class="col">
                            <div class="card card-elevated card-container">
                                <div class="card-content">
                                    <div class="text-center">
                                        7
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card card-elevated card-container">
                                <div class="card-content">
                                    <div class="text-center">

                                        8
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card card-elevated card-container">
                                <div class="card-content">
                                    <div class="text-center">

                                        9
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                    <!--Start of Biodata Management Form-->
                        <div class="container mt-5">
                            <h1 class="text-center">Biodata | Manage</h1>
                            <div class="row mb-3 justify-content-end">
                                <div class="col-12 text-right">
                                    <!-- Your button with the plus icon -->
                                    <button class="custom-button mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
                                        <i class="bi bi-plus"></i> Add New Record
                                    </button>
                                </div>
                            </div>


                            <div class="mb-3">
                                <input type="text" id="search" class="form-control" placeholder="Search...">
                            </div>
                            
                            <div id="biodataTable"></div>
                        </div>
                        
                        <!-- Add Modal -->
                        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addModalLabel">Add New Biodata</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="addForm" enctype="multipart/form-data">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="name" name="name" required>
                                            </div>


                                                <div class="mb-3">
                                                    <label for="category" class="form-label">Category</label>
                                                    <select class="form-control" id="category" name="category" required>
                                                        <option value="Admin">Admin</option>
                                                        <option value="Student">Student</option>
                                                        <option value="Teacher">Teacher</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="gender" class="form-label">Gender</label>
                                                    <select class="form-control" id="gender" name="gender" required>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                        
                                                    </select>
                                                </div>





                                            <div class="mb-3">
                                                <label for="date_of_birth" class="form-label">Date of Birth</label>
                                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="date_of_admission" class="form-label">Date of Admission</label>
                                                <input type="date" class="form-control" id="date_of_admission" name="date_of_admission"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="county" class="form-label">County</label>
                                                <input type="text" class="form-control" id="county" name="county" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="home_address" class="form-label">Home Address</label>
                                                <input type="text" class="form-control" id="home_address" name="home_address" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input type="text" class="form-control" id="phone" name="phone" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="upload_photo" class="form-label">Upload Photo</label>
                                                <input type="file" class="form-control" id="upload_photo" name="upload_photo" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit Biodata</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="editForm" enctype="multipart/form-data">
                                            <input type="hidden" id="edit_id" name="id">
                                            <div class="mb-3">
                                                <label for="edit_name" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="edit_name" name="name" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit_date_of_birth" class="form-label">Date of Birth</label>
                                                <input type="date" class="form-control" id="edit_date_of_birth" name="date_of_birth" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit_gender" class="form-label">Gender</label>
                                                <select class="form-control" id="edit_gender" name="gender" required>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>


                                            <div class="mb-3">
                                                <label for="category" class="form-label">Category</label>
                                                <select class="form-control" id="category" name="category" required>
                                                    <option value="Admin">Admin</option>
                                                    <option value="Student">Student</option>
                                                    <option value="Teacher">Teacher</option>
                                                </select>
                                            </div>




                                            <div class="mb-3">
                                                <label for="edit_date_of_admission" class="form-label">Date of Admission</label>
                                                <input type="date" class="form-control" id="edit_date_of_admission" name="date_of_admission"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit_county" class="form-label">County</label>
                                                <input type="text" class="form-control" id="edit_county" name="county" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit_home_address" class="form-label">Home Address</label>
                                                <input type="text" class="form-control" id="edit_home_address" name="home_address" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit_phone" class="form-label">Phone</label>
                                                <input type="text" class="form-control" id="edit_phone" name="phone" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit_email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="edit_email" name="email" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit_upload_photo" class="form-label">Upload Photo</label>
                                                <input type="file" class="form-control" id="edit_upload_photo" name="upload_photo">
                                                <input type="hidden" id="existing_photo" name="existing_photo">
                                                <img id="photo_preview" src="#" alt="Photo" style="max-width: 100px; display: none;">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <!--End Biodata Management Forms-->
                    
                   
                
            </div>
            <div class="col-sm-3 scrollable">
                <!-- Left column (menu and graphs) -->
                <div class="card-elevated p-5">
                    <img src="../images/branding/KS.png" alt="ksms Icon" class="icon-img">
                </div>
                <div class="card-elevated p-4">
                    
                        <div class="menu-toggle-1">
                            <a href="#" class="btn btn-primary d-block d-sm-none" id="menu-toggle-1">
                                <i class="bi bi-list"></i>
                                <span class="visually-hidden">Toggle Menu</span>
                            </a>
                        </div>
                        <!--MENU FORMAT-->
                        
                            <div class="menu-1">
                                <div class="menu-item-1">
                                    <a href="home.html" class="d-flex align-items-center p-2 rounded bg-light">
                                        <div class="card-elevated rounded-circle p-2 me-2"
                                            style="background-color: cornsilk;">
                                            <img src="../images/menu/subject.png" alt="Home Icon"
                                                class="img-fluid rounded-circle" style="max-width: 40px;">
                                        </div>
                                        <span class="ms-2" style="font-weight: bold;">Subjects</span>
                                    </a>
                                </div>
                                <hr>
                                <div class="menu-item-1">
                                    <a href="home.html" class="d-flex align-items-center p-2 rounded bg-light">
                                        <div class="card-elevated rounded-circle p-2 me-2"
                                            style="background-color: cornsilk;">
                                            <img src="../images/menu/staircase.png" alt="Home Icon"
                                                class="img-fluid rounded-circle" style="max-width: 40px;">
                                        </div>
                                        <span class="ms-2" style="font-weight: bold;">Progression</span>
                                    </a>
                                </div>
                                <div class="menu-item-1">
                                    <a href="home.html" class="d-flex align-items-center p-2 rounded bg-light">
                                        <div class="card-elevated rounded-circle p-2 me-2"
                                            style="background-color: cornsilk;">
                                            <img src="../images/menu/exam.png" alt="Home Icon"
                                                class="img-fluid rounded-circle" style="max-width: 40px;">
                                        </div>
                                        <span class="ms-2" style="font-weight: bold;">Examinations</span>
                                    </a>
                                </div>
                                <hr>
                                <div class="menu-item-1">
                                    <a href="home.html" class="d-flex align-items-center p-2 rounded bg-light">
                                        <div class="card-elevated rounded-circle p-2 me-2"
                                            style="background-color: cornsilk;">
                                            <img src="../images/menu/payments.png" alt="Home Icon"
                                                class="img-fluid rounded-circle" style="max-width: 40px;">
                                        </div>
                                        <span class="ms-2" style="font-weight: bold;">Payments</span>
                                    </a>
                                </div>
                                <hr>
                                <div class="menu-item-1">
                                    <a href="home.html" class="d-flex align-items-center p-2 rounded bg-light">
                                        <div class="card-elevated rounded-circle p-2 me-2"
                                            style="background-color: cornsilk;">
                                            <img src="../images/menu/welfare.png" alt="Home Icon"
                                                class="img-fluid rounded-circle" style="max-width: 40px;">
                                        </div>
                                        <span class="ms-2" style="font-weight: bold;">Welfare</span>
                                    </a>
                                </div>
                                <hr>
                                <div class="menu-item-1">
                                    <a href="home.html" class="d-flex align-items-center p-2 rounded bg-light">
                                        <div class="card-elevated rounded-circle p-2 me-2"
                                            style="background-color: cornsilk;">
                                            <img src="../images/menu/reports.png" alt="Home Icon"
                                                class="img-fluid rounded-circle" style="max-width: 40px;">
                                        </div>
                                        <span class="ms-2" style="font-weight: bold;">Reporting</span>
                                    </a>
                                </div>
                                <hr>
                            </div>
                        
                    <!--END OF CARD-//-->
                </div>
                
                    <div class="card-elevated align-items-center">
                        <div class="card p-5">
                            nnn
                        </div>
                   
                        
                </div>
                
            </div>
            <!--End of Scrollable Column-->
            <!--END F TEST FIT-->
        </div>

<!-- Logout Confirmation Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to log out?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <a href="../../logout.php" class="btn btn-danger">Logout</a>
                    </div>
                </div>
            </div>
        </div>




    </div>

    <!--Scripts Here-->
<script src="../includes/jscripts/biodata_crud.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!--End of Scripts-->
    
    

</body>
</html>