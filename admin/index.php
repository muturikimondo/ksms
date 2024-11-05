<?php
// File: admin/index.php

// Start session and check if user is an admin
session_start();
require 'admin_auth.php';  // Ensure this path is correct based on your file structure
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="includes/css/styles.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard-card {
            transition: transform 0.3s, box-shadow 0.3s;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        .card-image {
            width: 128px;
            height: 128px;
            object-fit: cover;
            margin-bottom: 20px;
            border-radius: 15px;
        }
        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
        }
        .card-body {
            padding: 15px;
            border-radius: 15px;
            background-color: #fff;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <!-- Logout Power Button in the Top Right -->
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#logoutModal" title="Logout">
                <i class="bi bi-power"></i>
            </button>
        </div>

        <h1 class="text-center mb-4">SMS-KE | Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?> (Admin)</h1>

        <div class="row g-4 justify-content-center">

            <!-- Register Card -->
            <div class="col-lg-4 col-md-6">
                <div class="card dashboard-card text-center">
                    <a href="register/index.php" class="text-decoration-none">
                        <div class="card-body">
                            <img src="images/register.png" alt="Register" class="card-image">
                            <h5 class="card-title">Student Register</h5>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Classes Card -->
            <div class="col-lg-4 col-md-6">
                <div class="card dashboard-card text-center">
                    <a href="classes/index.php" class="text-decoration-none">
                        <div class="card-body">
                            <img src="images/classes.png" alt="Classes" class="card-image">
                            <h5 class="card-title">Manage Classes</h5>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Subjects Card -->
            <div class="col-lg-4 col-md-6">
                <div class="card dashboard-card text-center">
                    <a href="subjects/index.php" class="text-decoration-none">
                        <div class="card-body">
                            <img src="images/subjects.png" alt="Subjects" class="card-image">
                            <h5 class="card-title">Manage Subjects</h5>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Classes & Students Card -->
            <div class="col-lg-4 col-md-6">
                <div class="card dashboard-card text-center">
                    <a href="classes_students/index.php" class="text-decoration-none">
                        <div class="card-body">
                            <img src="images/classes_students.png" alt="Classes & Students" class="card-image">
                            <h5 class="card-title">Classes & Students</h5>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Examinations Card -->
            <div class="col-lg-4 col-md-6">
                <div class="card dashboard-card text-center">
                    <a href="examinations/index.php" class="text-decoration-none">
                        <div class="card-body">
                            <img src="images/examinations.png" alt="Examinations" class="card-image">
                            <h5 class="card-title">Manage Examinations</h5>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Marks Card -->
            <div class="col-lg-4 col-md-6">
                <div class="card dashboard-card text-center">
                    <a href="marks/index.php" class="text-decoration-none">
                        <div class="card-body">
                            <img src="images/marks.png" alt="Marks" class="card-image">
                            <h5 class="card-title">Student Marks</h5>
                        </div>
                    </a>
                </div>
            </div>

        </div>
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
                    <a href="../logout.php" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.3 JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
