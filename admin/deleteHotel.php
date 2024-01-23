<?php
include '../connection/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the hotel_id parameter is provided
    if (isset($_POST['hotel_id'])) {
        $hotelId = mysqli_real_escape_string($conn, $_POST['hotel_id']);

        // Query to delete the hotel from the database
        $sql = "DELETE FROM hotels WHERE id = '$hotelId'";

        if ($conn->query($sql) === TRUE) {
            // Deletion was successful
            echo 'success';
            exit();
        } else {
            // Error occurred during deletion
            echo 'error';
        }
    } else {
        // Hotel ID parameter is missing
        echo 'missing_param';
    }
} else {
    // Invalid request method
    echo 'invalid_request';
}
?>
