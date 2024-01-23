
<?php 
include 'inc/header.php';
include '../connection/config.php';


function deleteTourPackage($conn, $id) {
    $id = mysqli_real_escape_string($conn, $id);
    $sql = "DELETE FROM tour_packages WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        return true; // Deletion successful
    } else {
        return false; // Deletion failed
    }
}

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    if (deleteTourPackage($conn, $delete_id)) {
        echo '<script>alert("Tour Package Deleted Successfully!."); window.location.href = "manageTour.php";</script>';
    } else {
        echo '<script>alert("Failed to delete tour package."); window.location.href = "manageTour.php";</script>';
    }
}
?>
        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5">
       
    
      <div class="container mt-5">
    <h2>All Tour Packages</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Description</th>
                <th>Tourist Spot</th>
                <th>Price</th>
                <th>Action</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM tour_packages";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td><img src="uploads/' . $row['image'] . '" alt="' . $row['title'] . '" class="img-fluid" style="max-width: 100px;"></td>';
                    echo '<td>' . $row['title'] . '</td>';
                    echo '<td>' . $row['description'] . '</td>';
                    echo '<td>' . $row['tourist_spot'] . '</td>';
                    echo '<td>৳ ' . $row['price'] . '</td>';
                    echo '<td>';
                    echo '<a href="editTour.php?id=' . $row['id'] . '" class="btn btn-primary btn-sm">Edit</a>';
                    echo '<a href="?delete_id=' . $row['id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this tour package?\')">Delete</a>';
                    echo '</td>';
                   
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="5">No tour packages found.</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>
      
      </div>
	</div>


<?php 
include 'inc/footer.php';
?>