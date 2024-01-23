<?php 
include 'inc/header.php';
include 'inc/navbar.php';
include 'connection/config.php';
?>
<div class="container">
    <div class="row">
    <div class="header d-flex justify-content-center mt5 mb-5">
        <h3>Welcome To Backpacker!</h3>
        </div>
        <div class="col-md-6 banner">
            <img src="assets/images/worldtour.png" alt="">
        </div>
        <div class="col-md-6 content">
           <p> "Our project is a comprehensive tourism management system that streamlines the process of booking hotels and tour packages. Users can explore various tour packages, view details, and make bookings. The system provides an easy-to-use admin panel for managing hotels and tours, including the ability to add, edit, and delete listings. Users can securely log in to view their booking history, and administrators can update booking statuses. This system simplifies travel planning, making it an ideal solution for both tourists and travel operators."</p>
        </div>
    </div>
</div>
<style>
.content p{
    margin-top:150px;
    text-align:justify;
}
.header h3{
    text-transform:uppercase;
}
</style>
<?php include 'inc/footer.php';?>
