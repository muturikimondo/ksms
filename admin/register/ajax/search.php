<?php
// Include the database connection
require_once '../../includes/db/config.php';

// Check if the query parameter is set
if (isset($_POST['query'])) {
    $query = $_POST['query'];
    
    // Prepare the SQL statement to prevent SQL injection
    if ($stmt = $conn->prepare("SELECT * FROM biodata WHERE name LIKE ? OR email LIKE ?")) {
        $likeQuery = "%" . $query . "%";
        $stmt->bind_param("ss", $likeQuery, $likeQuery);
        
        // Execute the statement
        if ($stmt->execute()) {
            // Get the result
            $result = $stmt->get_result();
            
            // Check if any records were found
            if ($result->num_rows > 0) {
                echo '<table class="table table-bordered">';
                echo '<thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Date of Birth</th>
                            <th>Gender</th>
                            <th>County</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Photo</th>
                            <th>Actions</th>
                        </tr>
                      </thead>';
                echo '<tbody>';

                // Fetch each record and display it
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>
                            <td>' . htmlspecialchars($row['id']) . '</td>
                            <td>' . htmlspecialchars($row['name']) . '</td>
                            <td>' . htmlspecialchars($row['date_of_birth']) . '</td>
                            <td>' . htmlspecialchars($row['gender']) . '</td>
                            <td>' . htmlspecialchars($row['county']) . '</td>
                            <td>' . htmlspecialchars($row['phone']) . '</td>
                            <td>' . htmlspecialchars($row['email']) . '</td>
                            <td><img src="uploads/' . htmlspecialchars($row['upload_photo']) . '" class="img-fluid" style="max-width: 50px; height: auto;"></td>
                            <td>
                                <button class="btn btn-warning edit-btn" data-id="' . htmlspecialchars($row['id']) . '">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-danger delete-btn" data-id="' . htmlspecialchars($row['id']) . '">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                          </tr>';
                }

                echo '</tbody></table>';
            } else {
                echo '<div class="alert alert-warning" role="alert">No records found.</div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">Error executing query: ' . $stmt->error . '</div>';
        }
        
        // Close the statement
        $stmt->close();
    } else {
        echo '<div class="alert alert-danger" role="alert">Error preparing statement: ' . $conn->error . '</div>';
    }
}

// Close the database connection
$conn->close();
?>
