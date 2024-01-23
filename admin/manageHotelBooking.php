<?php
include 'inc/header.php';
include '../connection/config.php';

// Function to update the status of a booked tour by ID
function updateStatus($conn, $id, $status) {
    $id = mysqli_real_escape_string($conn, $id);
    $status = mysqli_real_escape_string($conn, $status);
    $sql = "UPDATE bookhotels SET status = '$status' WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        return true; // Status update successful
    } else {
        return false; // Status update failed
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $booking_id = $_POST['booking_id'];
    $new_status = $_POST['new_status'];
    if (updateStatus($conn, $booking_id, $new_status)) {
        echo '<script>alert("Status updated successfully.!."); window.location.href = "manageHotelBooking.php";</script>';
    } else {
        echo '<script>alert("Failed to update status."); window.location.href = "manageHotelBooking.php";</script>';

    }
}
?>

<!-- Page Content -->
<div id="content" class="p-4 p-md-5 pt-5">
    <div class="container-fluid mt-5">
        <h2>Booked Tours</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Book Date</th>
                    <th>Amount</th>
                    <th>Bkash Number</th>
                    <th>Transaction Number</th>
                    <th>Status</th>
                    <th>Update Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM bookhotels";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['name'] . '</td>';
                        echo '<td>' . $row['email'] . '</td>';
                        echo '<td>' . $row['phone'] . '</td>';
                        echo '<td>' . $row['address'] . '</td>';
                        echo '<td>' . $row['book_date'] . '</td>';
                        echo '<td>' . $row['amount'] . '</td>';
                        echo '<td>' . $row['bkash_number'] . '</td>';
                        echo '<td>' . $row['transaction_number'] . '</td>';
                        echo '<td>' . $row['status'] . '</td>';
                        echo '<td>';
                        echo '<form method="post" action="">';
                        echo '<input type="hidden" name="booking_id" value="' . $row['id'] . '">';
                        echo '<select name="new_status" class="form-control">';
                        echo '<option value="Pending">Pending</option>';
                        echo '<option value="Approved">Approved</option>';
                        echo '<option value="Cancelled">Cancelled</option>';
                        echo '</select>';
                        echo '<button type="submit" name="update_status" class="btn btn-primary btn-sm mt-1">Update</button>';
                        echo '</form>';
                        echo '</td>';
                        echo '</tr>';
                       
                    }
                } else {
                    echo '<tr><td colspan="11">No booked tours found.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
