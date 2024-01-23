<?php
include 'inc/header.php';
include '../connection/config.php';

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
        // File upload was successful, insert hotel into the database
        $sql = "INSERT INTO hotels (title, description, location, image, price) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $title, $description, $location, $image_filename, $price);

        if ($stmt->execute()) {
            // Hotel added successfully
            echo '<script>alert("Hotel Added Successfully!."); window.location.href = "manageHotels.php";</script>';
            exit();
        } else {
            // Error inserting hotel
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        // Error uploading the image
        echo "Error uploading the image.";
    }
}
?>
<!-- Page Content -->
<div id="content" class="p-4 p-md-5 pt-5">
    <div class="container mt-5">
        <h2>Add Hotels</h2>
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
                <label for="location">Location:</label>
                <input type="text" class="form-control" id="location" name="location" required>
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
<?php
include 'inc/footer.php';
?>
