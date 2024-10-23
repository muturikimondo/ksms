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
    <title>KSMS | Admission Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../includes/css/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="../includes/jscripts/menu-1.js"></script>
    <style>
        .btn {
            padding: 0.25rem 0.5rem;
            border: none;
            background: transparent;
            color: inherit;
        }

        .btn:hover {
            color: #0056b3;
        }

        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #ffffff;
            border-bottom: 1px solid #dee2e6;
            z-index: 1000;
            padding: 0.5rem 1rem;
            box-shadow: 0 4px 2px -2px rgba(0, 0, 0, 0.1);
            height: 60px;
        }

        .content {
            padding-top: 70px;
        }

        .scrollable-content {
            overflow-y: auto;
            max-height: calc(100vh - 70px);
        }

        .form-lookup {
            width: 100%;
            background-color: #f8f9fa;
            color: #495057;
            border: none;
            border-bottom: 2px solid #007bff;
            padding: 0.75rem 0;
            appearance: none;
            box-sizing: border-box;
        }

        @media (max-width: 768px) {
            .form-lookup {
                font-size: 0.875rem;
                padding: 0.5rem 0;
            }
        }

        @media (max-width: 480px) {
            .form-lookup {
                font-size: 0.75rem;
                padding: 0.25rem 0;
            }
        }

        .custom-input,
        .custom-select {
            border: none;
            border-bottom: 2px solid #ced4da;
            border-radius: 0;
            padding: 0.5rem 0;
            font-size: 1rem;
            width: 100%;
            outline: none;
            background: transparent;
        }

        .custom-input:focus,
        .custom-select:focus {
            border-bottom: 2px solid #007bff;
            box-shadow: none;
        }

        .custom-select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            padding: 0;
            margin: 0;
        }
    </style>
    <script>
        $(document).ready(function () {
            $('#email').select2();
            $('#class').select2();
            $('#searchClass').select2();

            $.ajax({
                url: 'ajax/fetch_data.php',
                type: 'POST',
                data: { type: 'email' },
                success: function (response) {
                    $('#email').html(response);
                }
            });

            $.ajax({
                url: 'ajax/fetch_data.php',
                type: 'POST',
                data: { type: 'class' },
                success: function (response) {
                    $('#class').html(response);
                    $('#searchClass').html(response);
                }
            });

            $('#biodataForm').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: 'ajax/submit_or_update_admission.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        alert(response);
                        loadAdmissions();
                        $('#biodataForm')[0].reset();
                        $('#student_id').val('');
                        $('#submitBtn').html('<i class="fas fa-check-circle" style="font-size: 24px;"></i>');
                    }
                });
            });

            function loadAdmissions(query = '', className = '') {
                $.ajax({
                    url: 'ajax/load_admissions.php',
                    type: 'GET',
                    data: { search: query, className: className },
                    success: function (data) {
                        $('#admissionsTable tbody').html(data);
                    }
                });
            }

            loadAdmissions();

            $('#search').on('keyup', function () {
                var query = $(this).val();
                var className = $('#searchClass').val();
                loadAdmissions(query, className);
            });

            $('#searchClass').on('change', function () {
                var className = $(this).val();
                var query = $('#search').val();
                loadAdmissions(query, className);
            });

            $(document).on('click', '.delete-btn', function () {
                var id = $(this).data('id');
                if (confirm('Are you sure you want to delete this record?')) {
                    $.ajax({
                        url: 'ajax/delete_admission.php',
                        type: 'POST',
                        data: { id: id },
                        success: function (response) {
                            alert(response);
                            loadAdmissions();
                        }
                    });
                }
            });

            $(document).on('click', '.update-btn', function () {
                var id = $(this).data('id');
                $.ajax({
                    url: 'ajax/get_admission.php',
                    type: 'POST',
                    data: { id: id },
                    success: function (data) {
                        var admission = JSON.parse(data);
                        $('#student_id').val(admission.id);
                        $('#email').val(admission.student_email).trigger('change');
                        $('#adm_no').val(admission.admission_number);
                        $('#class').val(admission.class_admitted).trigger('change');

                        $('#submitBtn').html('<i class="fas fa-edit" style="font-size: 24px;"></i>');
                    }
                });
            });
        });

        function confirmLogout() {
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = '../../logout.php'; // Change to your logout URL
            }
        }
    </script>

</head>

<body>
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-danger" onclick="confirmLogout()" title="Logout">
            <i class="bi bi-power"></i>
        </button>
    </div>

    <h1 class="text-center mb-4">SMS-KE | Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?> (Admin)</h1>
    <div class="row mb-2">
        <div class="col-12">
            <div class="card-elevated"></div>
        </div>
    </div>

    <div class="container-fluid gradient-bg-1">
        <div class="row">
            <!-- Left column (menu and branding) -->
            <div class="col-sm-3 scrollable-content">
                <div class="card-elevated p-4">
                    <img src="../images/branding/KS.png" alt="ksms Icon" class="icon-img">
                </div>
                <div class="card-elevated p-4">
                    <div class="menu-1">
                        <div class="menu-item-1">
                            <a href="home.html" class="d-flex align-items-center p-2 rounded">
                                <div class="card-elevated rounded-circle p-2 me-2" style="background-color: cornsilk;">
                                    <img src="../images/menu/home.png" alt="Home Icon" class="img-fluid rounded-circle" style="max-width: 40px;">
                                </div>
                                <span class="ms-2" style="font-weight: bold;">Register</span>
                            </a>
                        </div>
                        <hr>
                        <div class="menu-item-1">
                            <a href="home.html" class="d-flex align-items-center p-2 rounded">
                                <div class="card-elevated rounded-circle p-2 me-2" style="background-color: cornsilk;">
                                    <img src="../images/menu/classroom.png" alt="Home Icon" class="img-fluid rounded-circle" style="max-width: 40px;">
                                </div>
                                <span class="ms-2" style="font-weight: bold;">Classes</span>
                            </a>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>

            <!-- Right column (form and table) -->
            <div class="col-sm-6 scrollable-content">
                <div class="card-elevated p-4">
                    <h3 class="text-center">Student Admission Form</h3>
                    <form id="biodataForm" method="post">
                        <input type="hidden" id="student_id" name="student_id" value="">
                        <div class="row">
                            <div class="col-12">
                                <label for="email">Email</label>
                                <select id="email" name="student_email" class="custom-select form-lookup" required>
                                    <option value="">Select Email</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="adm_no">Admission Number</label>
                                <input type="text" id="adm_no" name="admission_number" class="custom-input" required>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="class">Class</label>
                                <select id="class" name="class_admitted" class="custom-select form-lookup" required>
                                    <option value="">Select Class</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <button type="submit" id="submitBtn" class="btn btn-primary">
                                    <i class="fas fa-check-circle" style="font-size: 24px;"></i> Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-elevated p-4 mt-4">
                    <h3 class="text-center">Admissions List</h3>
                    <div class="row mb-3">
                        <div class="col-6">
                            <input type="text" id="search" placeholder="Search..." class="form-control">
                        </div>
                        <div class="col-6">
                            <select id="searchClass" class="custom-select form-lookup">
                                <option value="">All Classes</option>
                            </select>
                        </div>
                    </div>
                    <table class="table table-bordered" id="admissionsTable">
                        <thead>
                            <tr>
                            <th>Admission Number</th>
                                <th>Email</th>
                                <th>Class</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Dynamic rows go here -->
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Right column (menu and branding) -->
            <div class="col-sm-3 scrollable-content">
                <div class="card-elevated p-4">
                    <img src="../images/branding/KS.png" alt="ksms Icon" class="icon-img">
                </div>
                <div class="card-elevated p-4">
                    <div class="menu-1">
                        <div class="menu-item-1">
                            <a href="home.html" class="d-flex align-items-center p-2 rounded">
                                <div class="card-elevated rounded-circle p-2 me-2" style="background-color: cornsilk;">
                                    <img src="../images/menu/home.png" alt="Home Icon" class="img-fluid rounded-circle" style="max-width: 40px;">
                                </div>
                                <span class="ms-2" style="font-weight: bold;">Register</span>
                            </a>
                        </div>
                        <hr>
                        <div class="menu-item-1">
                            <a href="home.html" class="d-flex align-items-center p-2 rounded">
                                <div class="card-elevated rounded-circle p-2 me-2" style="background-color: cornsilk;">
                                    <img src="../images/menu/classroom.png" alt="Home Icon" class="img-fluid rounded-circle" style="max-width: 40px;">
                                </div>
                                <span class="ms-2" style="font-weight: bold;">Classes</span>
                            </a>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
