
<?php 
include 'inc/header.php';
include '../connection/config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the form submission
    $title = $_POST['title'];
    $description = $_POST['description'];
    $tourist_spot = $_POST['tourist_spot'];
    $price = $_POST['price'];

    // Handle file upload (product image)
    $upload_dir = 'uploads/'; // Create this directory in your project
    $image_filename = basename($_FILES['image']['name']);
    $target_file = $upload_dir . $image_filename;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        // File upload was successful, insert product into the database
        $sql = "INSERT INTO tour_packages (title, description, tourist_spot	, image, price) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $title, $description, $tourist_spot, $image_filename, $price);

        if ($stmt->execute()) {
            // Product added successfully
            echo '<script>alert("Tour Added Successfully!."); window.location.href = "manageTour.php";</script>';
            exit();
        } else {
            // Error inserting product
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        // Error uploading the image
        echo "Error uploading the image.";
    }
}
?>
        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5">
       
      <div class="container mt-5">
        <h2>Add Tour Package</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="tourist_spot">Tourist Spot:</label>
                <input type="text" class="form-control" id="tourist_spot" name="tourist_spot" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Package</button>
        </form>
    </div>

      
      </div>
	</div>


<?php 
include 'inc/footer.php';
?>