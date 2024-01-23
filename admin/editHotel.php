<?php
include 'inc/header.php';
include '../connection/config.php';

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $hotelId = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Fetch hotel details from the database based on the ID
    $sql = "SELECT * FROM hotels WHERE id = $hotelId";
    $result = $conn->query($sql);
    
    // Check if a record with the given ID exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $title = $row['title'];
        $description = $row['description'];
        $location = $row['location'];
        $price = $row['price'];
        $image = $row['image'];
        
        // Check if the form is submitted for updating
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Process the form submission
            $title = $_POST['title'];
            $description = $_POST['description'];
            $location = $_POST['location'];
            $price = $_POST['price'];

            // Handle file upload (hotel image)
            $upload_dir = 'hotels/'; // Create this directory in your project
            $image_filename = basename($_FILES['image']['name']);
            $target_file = $upload_dir . $image_filename;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                // File upload was successful, update hotel information in the database
                $update_sql = "UPDATE hotels SET title=?, description=?, location=?, image=?, price=? WHERE id=?";
                $stmt = $conn->prepare($update_sql);
                $stmt->bind_param("ssssdi", $title, $description, $location, $image_filename, $price, $hotelId);

                if ($stmt->execute()) {
                    // Hotel updated successfully
                    echo '<script>alert("Hotel Updated Successfully!.");</script>';
                } else {
                    // Error updating hotel
                    echo '<script>alert("Error: ' . $stmt->error . '");</script>';
                }
                $stmt->close();
            } else {
                // Error uploading the image
                echo '<script>alert("Error uploading the image.");</script>';
            }
        }
    } else {
        // Handle the case where the hotel with the specified ID was not found
        echo "Hotel not found.";
        exit();
    }
} else {
    // Handle the case where 'id' parameter is not set in the URL
    echo "Hotel ID not provided.";
    exit();
}
?>

<div id="content" class="p-4 p-md-5 pt-5">
    <div class="container mt-5">
        <h2>Edit Hotel</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="hotel_id" value="<?php echo $hotelId; ?>">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $title; ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="4" required><?php echo $description; ?></textarea>
            </div>
            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" class="form-control" id="location" name="location" value="<?php echo $location; ?>" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" class="form-control" id="price" name="price" value="<?php echo $price; ?>" required>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                <img src="hotels/<?php echo $image; ?>" alt="<?php echo $title; ?>" width="100">
            </div>
            <button type="submit" class="btn btn-primary">Update Hotel</button>
        </form>
    </div>
</div>

<?php
include 'inc/footer.php';
?>
