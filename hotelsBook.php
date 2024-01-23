<?php 
include 'inc/header.php';
include 'inc/navbar.php';
include 'connection/config.php';

// Fetch tour packages from the database
$sql = "SELECT id, title, description, image, price FROM hotels";
$result = $conn->query($sql);
?>
<div class="container">
    <div class="row">
    <div class="header d-flex justify-content-center mt5 mb-5">
        <h3>BOOK OUR HOTELS</h3>
        <hr>
        </div>
        <?php
        // Loop through the tour packages and display them
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $title = $row['title'];
            $description = $row['description'];
            $image = $row['image'];
            $price = $row['price'];
        ?>
        <div class="col-md-3 p-2">
        <div class="card" style="height:400px;">
        <img src="admin/hotels/<?php echo $image; ?>" class="card-img" height=200px; alt="<?php echo $title; ?>">
        <div class="card-body">
        <h5 class="card-title"><?php echo $title; ?></h5>
        <h6 class="mt-4">Price: <?php echo $price; ?></h6>
        <a href="hotelDetails.php?id=<?php echo $id; ?>"><button class="btn btn-info mt-2">View Details</button></a>
        </div>
    </div>
        </div>
        <?php
        } // End of while loop
        ?>   
    </div>
</div>

<style>
    .container{
        margin-top:100px;
    }
    .card-text{
        text-align:justify;
    }
</style>
<?php include 'inc/footer.php';?>
