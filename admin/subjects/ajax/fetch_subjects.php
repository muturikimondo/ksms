<?php
include '../../includes/db/config.php';

$sql = "SELECT * FROM subjects";
$result = $conn->query($sql);

$output = '';
while ($row = $result->fetch_assoc()) {
    $output .= '<tr>';
    $output .= '<td>' . $row['id'] . '</td>';
    $output .= '<td>' . $row['code'] . '</td>';
    $output .= '<td>' . $row['name'] . '</td>';
    $output .= '<td>' . $row['subject_group'] . '</td>';
    $output .= '<td>
                    <button class="btn btn-info edit" data-id="' . $row['id'] . '">Edit</button>
                    <button class="btn btn-danger delete" data-id="' . $row['id'] . '">Delete</button>
                </td>';
    $output .= '</tr>';
}

echo $output;
?>
