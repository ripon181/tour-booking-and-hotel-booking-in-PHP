<?php 
session_start();
include 'inc/header.php';
include 'inc/navbar.php';
include 'connection/config.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Display the login modal when the user is not logged in
    header('login.php');
} else {
    // Retrieve the user's ID from the session
    $user_id =  $_SESSION["id"];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and retrieve form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $tour_date = $_POST['tour_date'];
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $bkash_number = mysqli_real_escape_string($conn, $_POST['bkash_number']);
    $transaction_number = mysqli_real_escape_string($conn, $_POST['transaction_number']);
   
   
    $status = 'pending';
    // Insert data into the bookTour table
    $sql = "INSERT INTO booktour (user_id,name, email, phone, address, tour_date, amount, bkash_number, transaction_number, status)
            VALUES ('$user_id', '$name', '$email', '$phone', '$address', '$tour_date', '$amount', '$bkash_number', '$transaction_number', '$status')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Tour Booked Successfull !!!."); window.location.href = "myAccount.php";</script>';
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}




// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $tourId = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Fetch tour package details from the database based on the ID
    $sql = "SELECT * FROM tour_packages WHERE id = $tourId";
    $result = $conn->query($sql);
    
    // Check if a record with the given ID exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $title = $row['title'];
        $description = $row['description'];
        $image = $row['image'];
        $touristSpot = $row['tourist_spot'];
        $price = $row['price'];
    } else {
        // Handle the case where the tour package with the specified ID was not found
        echo "Tour package not found.";
    }
} else {
    // Handle the case where 'id' parameter is not set in the URL
    echo "Tour package ID not provided.";
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="banner">
                <img src="admin/uploads/<?php echo $image; ?>" alt="<?php echo $title; ?>" class="img-fluid">
            </div>
        </div>
        <div class="col-md-6">
            <div class="content">
                <h3><?php echo $title; ?></h3>
                <p><?php echo $description; ?></p>
                <h6>Tourist Spot: <?php echo $touristSpot; ?></h6>
                <h5>Price: ৳ <?php echo $price; ?></h5>
                <button class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#bookModal">Book Now</button>

            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="bookModal" tabindex="-1" aria-labelledby="bookModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookModalLabel">Book This Tour Package</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Booking Form -->
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone:</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address:</label>
                        <textarea class="form-control" id="address" name="address" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="tour_date" class="form-label">Date:</label>
                        <input type="date" class="form-control" id="tour_date" name="tour_date" required>
                    </div>
                    <div class="mb-3">
                    <h5>Please make your payment on this number (Bkash-01749475566) then fill up the form</h5>
                        <label for="amount" class="form-label">Amouont:</label>
                        <input type="text" class="form-control" id="amount" name="amount" required>
                    </div>
                    <div class="mb-3">
                        <label for="bkash_number" class="form-label">Bkash Number:</label>
                        <input type="text" class="form-control" id="bkash_number" name="bkash_number" required>
                    </div>
                    <div class="mb-3">
                        <label for="transaction_number" class="form-label">Transaction Number:</label>
                        <input type="text" class="form-control" id="transaction_number" name="transaction_number" required>
                    </div>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Submit Booking</button>
            </div>
            </form>
        </div>
    </div>
</div>


<style>
    .container {
        margin-top: 100px;
    }
    .content p {
        text-align: justify;
    }
    .banner img {
        border-radius: 8px;
        border: 2px solid #ff6a00;
        height: 350px;
        width: 88%;
    }
</style>


<?php include 'inc/footer.php'; ?>