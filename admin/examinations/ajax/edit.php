<?php
include '../../includes/db/config.php'; // Include the database connection

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare and execute query to fetch the examination details
    $stmt = $conn->prepare("SELECT * FROM examinations WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo "No examination found with the provided ID.";
        exit;
    }

    $row = $result->fetch_assoc();
    $exam_type = $row['exam_type'];
    $exam_month = $row['exam_month'];
    $exam_year = $row['exam_year'];
    $exam_name = $row['exam_name'];

    $stmt->close();
} else {
    echo "No ID provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Examination</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../includes/css/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Examination</h2>
        <div class="card mb-4">
            <div class="card-header">Edit Examination Details</div>
            <div class="card-body">
                <form action="update.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

                    <!-- Select Exam Type -->
                    <div class="mb-3">
                        <label for="exam_type" class="form-label">Exam Type</label>
                        <select class="form-select select2" id="exam_type" name="exam_type" required>
                            <option value="CAT" <?php echo $exam_type === 'CAT' ? 'selected' : ''; ?>>CAT (Continuous Assessment Test)</option>
                            <option value="RAT" <?php echo $exam_type === 'RAT' ? 'selected' : ''; ?>>RAT (Random Assessment Test)</option>
                            <option value="EOT" <?php echo $exam_type === 'EOT' ? 'selected' : ''; ?>>EOT (End of Term Test)</option>
                        </select>
                    </div>

                    <!-- Select Exam Month -->
                    <div class="mb-3">
                        <label for="exam_month" class="form-label">Exam Month</label>
                        <select class="form-select select2" id="exam_month" name="exam_month" required>
                            <?php
                            $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                            foreach ($months as $month) {
                                echo "<option value='$month' " . ($exam_month === $month ? 'selected' : '') . ">$month</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Input Exam Year -->
                    <div class="mb-3">
                        <label for="exam_year" class="form-label">Exam Year</label>
                        <input type="number" class="form-control" id="exam_year" name="exam_year" value="<?php echo htmlspecialchars($exam_year); ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Examination</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Activate Select2 for searchability
        $('.select2').select2();
    </script>
</body>
</html>
