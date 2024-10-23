<?php
session_start();
if (!isset($_SESSION['user_category']) || $_SESSION['user_category'] !== 'teachers') {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Welcome to Teachers' Dashboard, <?php echo $_SESSION['user_name']; ?>!</h1>
        <a href="../logout.php" class="btn btn-danger">Logout</a>
    </div>
</body>
</html>
