<?php
// Include the database connection
include('../../includes/db/config.php');

// Check if a search term is provided
if (isset($_POST['search'])) {
    $search = $_POST['search'];

    // Prepare the SQL query to filter based on student_class, email, or name
    $query = "
        SELECT * FROM student_full_info 
        WHERE 
            class_admitted LIKE '%$search%' OR 
            email LIKE '%$search%' OR 
            name LIKE '%$search%'
    ";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if any rows were returned
    if (mysqli_num_rows($result) > 0) {
        // Fetch and display each row
        while ($row = mysqli_fetch_assoc($result)) {
            echo "
                <tr>
                    <td>{$row['biodata_id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['date_of_birth']}</td>
                    <td>{$row['gender']}</td>
                    <td>{$row['date_of_admission']}</td>
                    <td>{$row['county']}</td>
                    <td>{$row['home_address']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['category']}</td>
                    <td>{$row['admission_number']}</td>
                    <td>{$row['class_admitted']}</td>
                </tr>
            ";
        }
    } else {
        // No results found
        echo "<tr><td colspan='12'>No results found</td></tr>";
    }
}
?>
