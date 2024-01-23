<?php
include 'inc/header.php';
include '../connection/config.php';

// Function to update the status of a booked tour by ID
function updateStatus($conn, $id, $status) {
    $id = mysqli_real_escape_string($conn, $id);
    $status = mysqli_real_escape_string($conn, $status);
    $sql = "UPDATE booktour SET status = '$status' WHERE id = '$id'";
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
        echo '<script>alert("Status updated successfully.!."); window.location.href = "manageTourBooking.php";</script>';
    } else {
        echo '<script>alert("Failed to update status."); window.location.href = "manageTourBooking.php";</script>';

    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['return_cash'])) {
    // Handle the return cash form submission here
    $booking_id = $_POST['booking_id'];
    $bkash_number = mysqli_real_escape_string($conn, $_POST['bkash_number']);
    $transaction_number = mysqli_real_escape_string($conn, $_POST['transaction_number']);
    
    // Update the database with the bkash_number and transaction_number
    $sql = "UPDATE booktour SET bkash_number = '$bkash_number', transaction_number = '$transaction_number' WHERE id = '$booking_id'";
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Cash returned successfully.!."); window.location.href = "manageTourBooking.php";</script>';
    } else {
        echo '<script>alert("Failed to return cash.!."); window.location.href = "manageTourBooking.php";</script>';
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
                    <th>Tour Date</th>
                    <th>Amount</th>
                    <th>Bkash Number</th>
                    <th>Transaction Number</th>
                    <th>Booking Date</th>
                    <th>Status</th>
                    <th>Update Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM booktour";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['name'] . '</td>';
                        echo '<td>' . $row['email'] . '</td>';
                        echo '<td>' . $row['phone'] . '</td>';
                        echo '<td>' . $row['address'] . '</td>';
                        echo '<td>' . $row['tour_date'] . '</td>';
                        echo '<td>' . $row['amount'] . '</td>';
                        echo '<td>' . $row['bkash_number'] . '</td>';
                        echo '<td>' . $row['transaction_number'] . '</td>';
                        echo '<td>' . $row['booking_date'] . '</td>';
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
                        
                        // Display the return cash form when status is "Cancelled"
                        if ($row['status'] === 'Cancelled') {
                            echo '<tr>';
                            echo '<td colspan="11">';
                            echo '<button class="btn btn-danger" data-toggle="modal" data-target="#returnCashModal' . $row['id'] . '">Return Cash</button>';
                            echo '</td>';
                            echo '</tr>';
                            
                            // Return Cash Modal
                            echo '<div class="modal fade" id="returnCashModal' . $row['id'] . '" tabindex="-1" role="dialog" aria-labelledby="returnCashModalLabel' . $row['id'] . '" aria-hidden="true">';
                            echo '<div class="modal-dialog" role="document">';
                            echo '<div class="modal-content">';
                            echo '<div class="modal-header">';
                            echo '<h5 class="modal-title" id="returnCashModalLabel' . $row['id'] . '">Return Cash</h5>';
                            echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                            echo '<span aria-hidden="true">&times;</span>';
                            echo '</button>';
                            echo '</div>';
                            echo '<div class="modal-body">';
                            echo '<p>Please return amount on this number (' . $row['phone'] . ')</p>';
                            echo '<form method="post" action="">';
                            echo '<input type="hidden" name="booking_id" value="' . $row['id'] . '">';
                            echo '<div class="form-group">';
                            echo '<label for="bkash_number' . $row['id'] . '">Bkash Number:</label>';
                            echo '<input type="text" class="form-control" id="bkash_number' . $row['id'] . '" name="bkash_number" required>';
                            echo '</div>';
                            echo '<div class="form-group">';
                            echo '<label for="transaction_number' . $row['id'] . '">Transaction Number:</label>';
                            echo '<input type="text" class="form-control" id="transaction_number' . $row['id'] . '" name="transaction_number" required>';
                            echo '</div>';
                            echo '<button type="submit" name="return_cash" class="btn btn-primary">Return Cash</button>';
                            echo '</form>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
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
