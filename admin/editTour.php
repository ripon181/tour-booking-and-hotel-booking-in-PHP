<?php
include 'inc/header.php';
include '../connection/config.php';

if (isset($_GET['id'])) {
    $tourId = $_GET['id'];

    $sql = "SELECT * FROM tour_packages WHERE id = $tourId";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $currentTitle = $row['title'];
        $currentDescription = $row['description'];
        $currentTouristSpot = $row['tourist_spot'];
        $currentPrice = $row['price'];
        $currentImage = $row['image']; // Get the current image file name
    } else {
        echo "Tour package not found.";
        exit();
    }
} else {
    echo "Tour package ID not provided.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $newTitle = mysqli_real_escape_string($conn, $_POST['new_title']);
    $newDescription = mysqli_real_escape_string($conn, $_POST['new_description']);
    $newTouristSpot = mysqli_real_escape_string($conn, $_POST['new_tourist_spot']);
    $newPrice = mysqli_real_escape_string($conn, $_POST['new_price']);
    
    // Check if a new image is uploaded
    if ($_FILES['new_image']['size'] > 0) {
        $upload_dir = 'uploads/';
        $newImageFilename = basename($_FILES['new_image']['name']);
        $target_file = $upload_dir . $newImageFilename;
        
        if (move_uploaded_file($_FILES['new_image']['tmp_name'], $target_file)) {
            // Delete the old image if a new one is uploaded
            unlink($upload_dir . $currentImage);
            $currentImage = $newImageFilename;
        } else {
            echo "Error uploading the new image.";
        }
    }

    $updateSql = "UPDATE tour_packages 
                  SET title = '$newTitle', description = '$newDescription', 
                  tourist_spot = '$newTouristSpot', price = '$newPrice', image = '$currentImage' 
                  WHERE id = $tourId";

    if ($conn->query($updateSql) === TRUE) {
        echo '<script>alert("Tour package updated successfully."); window.location.href = "manageTour.php";</script>';
        exit();
    } else {
        echo "Error updating tour package: " . $conn->error;
    }
}
?>

<div id="content" class="p-4 p-md-5 pt-5">
    <div class="container mt-5">
        <h2>Edit Tour Package</h2>
        <form action="editTour.php?id=<?php echo $tourId; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="new_title">Title:</label>
                <input type="text" class="form-control" id="new_title" name="new_title" value="<?php echo $currentTitle; ?>" required>
            </div>
            <div class="form-group">
                <label for="new_description">Description:</label>
                <textarea class="form-control" id="new_description" name="new_description" rows="4" required><?php echo $currentDescription; ?></textarea>
            </div>
            <div class="form-group">
                <label for="new_tourist_spot">Tourist Spot:</label>
                <input type="text" class="form-control" id="new_tourist_spot" name="new_tourist_spot" value="<?php echo $currentTouristSpot; ?>" required>
            </div>
            <div class="form-group">
                <label for="new_price">Price:</label>
                <input type="number" class="form-control" id="new_price" name="new_price" value="<?php echo $currentPrice; ?>" required>
            </div>
            <div class="form-group">
                <label for="new_image">New Image:</label>
                <input type="file" class="form-control-file" id="new_image" name="new_image" accept="image/*">
                <img src="uploads/<?php echo $currentImage; ?>" alt="image" width=100>
            </div>
            <button type="submit" class="btn btn-primary" name="update">Update Tour Package</button>
        </form>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
