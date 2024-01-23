<?php
include 'inc/header.php';
include 'inc/navbar.php';
include 'connection/config.php';

// Fetch tour packages from the database
$sql = "SELECT id, title, description, image, price FROM tour_packages";
$result = $conn->query($sql);
?>

<div class="container">
    <div class="row">
        <div class="header d-flex justify-content-center mt5 mb-5">
            <h3>BOOK OUR TOUR PACKAGES</h3>
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
        <div class="col-md-6">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="admin/uploads/<?php echo $image; ?>" class="card-img" height=100% alt="<?php echo $title; ?>">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $title; ?></h5>
                            <h6 class="mt-4">Price : <?php echo $price; ?></h6>
                            <a href="tourDetails.php?id=<?php echo $id; ?>"><button class="btn btn-info mt-2">View Details</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        } // End of while loop
        ?>

    </div>
</div>
<style>
    .card-body{
        height:160px;
    }
</style>
<?php include 'inc/footer.php';?>
