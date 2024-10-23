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
    <title>KSMS | Examination Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../includes/css/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> <!-- Added Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#logoutModal" title="Logout">
                <i class="bi bi-power"></i>
            </button>
        </div>

        <h2 class="text-center">Manage Examinations</h2>

        <!-- Add Examination Form -->
        <div class="card-elevated mb-4">
            <span><h3>Add New Examination</h3></span>
            <div class="card-body">
                <form action="ajax/insert.php" method="POST">
                    <div class="row">
                        <div class="row mb-3">
                            <div class="col-3">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="exam_type" class="form-label">Exam Type</label>
                                    </div>
                                    <div class="col-md-8">
                                        <select class="form-select select2" id="exam_type" name="exam_type" required>
                                            <option value="CAT">CAT (Continuous Assessment Test)</option>
                                            <option value="RAT">RAT (Random Assessment Test)</option>
                                            <option value="EOT">EOT (End of Term Test)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="exam_month" class="form-label">Exam Month</label>
                                    </div>
                                    <div class="col-md-8">
                                        <select class="form-select select2" id="exam_month" name="exam_month" required>
                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="March">March</option>
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="June">June</option>
                                            <option value="July">July</option>
                                            <option value="August">August</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-3 mb-3">
                                <div class="row">
                                    <div class="col-4"><label for="exam_year" class="form-label">Exam Year</label></div>
                                    <div class="col-8"><input type="number" class="form-control" id="exam_year" name="exam_year" required></div>
                                </div>
                            </div>
                            
                            <div class="col-3 mb-3 text-center">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                
                <!-- Examinations Table -->
                <span><h3>Examinations List</h3></span>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Exam Type</th>
                            <th>Exam Month</th>
                            <th>Exam Year</th>
                            <th>Exam Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include '../includes/db/config.php'; // Include connection string
                        $result = $conn->query("SELECT * FROM examinations");
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $exam_name = $row['exam_type'] . " - " . $row['exam_month'] . " " . $row['exam_year'];
                                echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['exam_type']}</td>
                                    <td>{$row['exam_month']}</td>
                                    <td>{$row['exam_year']}</td>
                                    <td>{$exam_name}</td>
                                    <td>
                                        <a href='ajax/edit.php?id={$row['id']}' class='btn btn-warning btn-sm'>
                                            <i class='fas fa-edit'></i>
                                        </a>
                                        <a href='ajax/delete.php?id={$row['id']}' class='btn btn-danger btn-sm'>
                                            <i class='fas fa-trash'></i>
                                        </a>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>No examinations found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
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
                        <a href="../../logout.php" class="btn btn-danger">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.select2').select2(); // Initialize select2
    </script>
</body>

</html>
