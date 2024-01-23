<?php
include 'inc/header.php';
include '../connection/config.php';

// Function to delete a hotel by ID
function deleteHotel($conn, $hotelId) {
    $sql = "DELETE FROM hotels WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $hotelId);

    if ($stmt->execute()) {
        return true; // Deletion was successful
    } else {
        return false; // Error occurred during deletion
    }
}

// Check if a hotel deletion request is made
if (isset($_GET['delete_id'])) {
    $deleteHotelId = $_GET['delete_id'];
    if (deleteHotel($conn, $deleteHotelId)) {
        echo '<div class="alert alert-success">Hotel deleted successfully.</div>';
    } else {
        echo '<div class="alert alert-danger">Error deleting the hotel.</div>';
    }
}

// Fetch hotel data from the database
$sql = "SELECT * FROM hotels";
$result = $conn->query($sql);
?>

<!-- Page Content -->
<div id="content" class="p-4 p-md-5 pt-5">
    <div class="container mt-5">
        <h2>Manage Hotels</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Location</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td><img src="hotels/' . $row['image'] . '" alt="' . $row['title'] . '" width="100"></td>';
                        echo '<td>' . $row['title'] . '</td>';
                        echo '<td>' . $row['description'] . '</td>';
                        echo '<td>' . $row['location'] . '</td>';
                        echo '<td>' . $row['price'] . '</td>';
                        echo '<td>';
                        echo '<a href="editHotel.php?id=' . $row['id'] . '" class="btn btn-primary btn-sm">Edit</a>';
                        echo ' <a href="?delete_id=' . $row['id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this hotel?\')">Delete</a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="6">No hotels found.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include 'inc/footer.php';
?>
