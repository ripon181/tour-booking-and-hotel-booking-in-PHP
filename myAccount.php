<?php 
session_start();
include 'inc/header.php';
include 'inc/navbar.php';
include 'connection/config.php';
?>
<link rel="stylesheet" href="assets/css/myAccount.css">

<div class="container-fluid mt-5">
    <div class="d-flex bg-white flex-row shadow nav-border">
        <div class="d-flex align-items-start">
            <div class="nav flex-column nav-pills me-3 nav-shadow pb-5" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">
                    <div class="circle-icon d-flex align-items-center justify-content-center me-3"> <img src="assets/images/my-account/user.png" alt="" class="img-fluid"> </div>
                    Account
                </button>
                <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                    <div class="circle-icon d-flex align-items-center justify-content-center me-3"> <img src="assets/images/my-account/hotel.png" alt="" class="img-fluid"> </div>
                    Hotel Booking
                </button>
                <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                    <div class="circle-icon d-flex align-items-center justify-content-center me-3"> <img src="assets/images/my-account/tour.png" alt="" class="img-fluid"> </div>
                    Tour Booking
                </button>

                <button class="nav-link" id="v-pills-shared-tab" data-bs-toggle="pill" data-bs-target="#v-pills-shared" type="button" role="tab" aria-controls="v-pills-shared" aria-selected="false">
                    <div class="circle-icon d-flex align-items-center justify-content-center me-3"> <img src="assets/images/my-account/share.png" alt="" class="img-fluid"> </div>
                    Shared Ticket
                </button>
            </div>
        </div>
        <div class="tab-content" id="v-pills-tabContent">
        
            <div class="tab-pane fade show active pt-4 me-4" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
            <h5>
        WELCOME BACK!
        </h5>
        <h2>
        <?php echo $_SESSION["user_name"]; ?>! <!-- Display the user's name here -->
        </h2>
            </div>
          <!-- Tab 2: Hotel Booking -->
            <div class="tab-pane fade pt-4 me-4" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                <?php
                $session_user = $_SESSION["id"];
                $sql = "SELECT * FROM bookhotels WHERE `user_id`= '$session_user'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo '<div class="container mt-5">';
                    echo '<h2>Hotel Booking Details</h2>';
                    echo '<table class="table table-striped">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>Name</th>';
                    echo '<th>Email</th>';
                    echo '<th>Phone</th>';
                    echo '<th>Address</th>';
                    echo '<th>Book Date</th>';
                    echo '<th>Amount</th>';
                    echo '<th>Bkash Number</th>';
                    echo '<th>Transaction Number</th>';
                    echo '<th>Status</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['name'] . '</td>';
                        echo '<td>' . $row['email'] . '</td>';
                        echo '<td>' . $row['phone'] . '</td>';
                        echo '<td>' . $row['address'] . '</td>';
                        echo '<td>' . $row['book_date'] . '</td>';
                        echo '<td>' . $row['amount'] . '</td>';
                        echo '<td>' . $row['bkash_number'] . '</td>';
                        echo '<td>' . $row['transaction_number'] . '</td>';
                        echo '<td>' . $row['status'] . '</td>';
                        echo '</tr>';
                    }

                    echo '</tbody>';
                    echo '</table>';
                    echo '</div>';
                } else {
                    echo '<div class="container mt-5">';
                    echo '<h2>No Hotel Booking Records Found</h2>';
                    echo '</div>';
                }
                ?>
            </div>


            <!-- Tab 4: Tour Booking Tickets -->
            <div class="tab-pane fade pt-4 me-4" id="v-pills-shared" role="tabpanel" aria-labelledby="v-pills-shared-tab">
                <?php
                 $session_user = $_SESSION["id"]; 
                // Assuming you have the current user's ID in $session_user
                $sql = "SELECT st.*, bt.name AS ticket_name, bt.email AS ticket_email, bt.phone AS ticket_phone, bt.tour_date AS ticket_tour_date, bt.status AS ticket_status, bt.amount AS ticket_price
                        FROM shared_tickets st
                        JOIN booktour bt ON st.ticket_id = bt.id
                        WHERE st.recipient_id = '$session_user'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo '<div class="container mt-5">';
                    echo '<h2>Shared Tickets</h2>';
                    echo '<table class="table table-striped">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>Name</th>';
                    echo '<th>Email</th>';
                    echo '<th>Phone</th>';
                    echo '<th>Tour Date</th>';
                    echo '<th>Status</th>';
                    echo '<th>View Ticket</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['ticket_name'] . '</td>';
                        echo '<td>' . $row['ticket_email'] . '</td>';
                        echo '<td>' . $row['ticket_phone'] . '</td>';
                        echo '<td>' . $row['ticket_tour_date'] . '</td>';
                        echo '<td>' . $row['ticket_status'] . '</td>';
                        echo '<td><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewTicketModal' . $row['id'] . '">View Ticket</button></td>';
                        echo '</tr>';

                        // Create a modal for viewing the shared ticket
                        echo '<div class="modal fade" id="viewTicketModal' . $row['id'] . '" tabindex="-1" aria-labelledby="viewTicketModalLabel' . $row['id'] . '" aria-hidden="true">';
                        echo '<div class="modal-dialog">';
                        echo '<div class="modal-content">';
                        echo '<div class="modal-header">';
                        echo '<h5 class="modal-title" id="viewTicketModalLabel">Booking Details</h5>';
                        echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                        echo '</div>';
                        echo '<div class="modal-body">';
                        // Include the necessary booking details here
                        echo '<div style="position: relative;">';
                        echo '<img src="assets/images/ticket.png" alt="Image" class="img-fluid mb-3">';
                        echo '<div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 24px; color: white; font-weight: bold;">BACKPACKERS</div>';
                        echo '</div>';

                        echo '<p>Name: ' . $row['ticket_name'] . '</p>';
                        echo '<p>Email: ' . $row['ticket_email'] . '</p>';
                        echo '<p>Phone: ' . $row['ticket_phone'] . '</p>';
                        echo '<p>Tour Date: ' . $row['ticket_tour_date'] . '</p>';
                        echo '<p>Ticket Price: ' . $row['ticket_price'] . '</p>';
                        echo '</div>';
                        echo '<div class="modal-footer">';
                        echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }

                    echo '</tbody>';
                    echo '</table>';
                    echo '</div>';
                } else {
                    echo '<div class="container mt-5">';
                    echo '<h2>No Shared Tickets Found</h2>';
                    echo '</div>';
                }
                ?>
            </div>
            <!-- Tab 3: Share Booking -->
            <div class="tab-pane fade pt-4 me-4" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                <?php
                $session_user = $_SESSION["id"];
                $sql = "SELECT * FROM booktour WHERE `user_id`= '$session_user'";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo '<div class="container mt-5">';
                    echo '<h2>Booking Details</h2>';
                    echo '<table class="table table-striped">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>Name</th>';
                    echo '<th>Email</th>';
                    echo '<th>Phone</th>';
                    echo '<th>Tour Date</th>';
                    echo '<th>Status</th>';
                    echo '<th>View Ticket</th>';
                    echo '<th>Share Ticket</th>'; // Add a new column for sharing
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['name'] . '</td>';
                        echo '<td>' . $row['email'] . '</td>';
                        echo '<td>' . $row['phone'] . '</td>';
                        echo '<td>' . $row['tour_date'] . '</td>';
                        echo '<td>' . $row['status'] . '</td>';
                        echo '<td><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewTicketModal' . $row['id'] . '">View Ticket</button></td>';
                        echo '<td><button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#shareTicketModal' . $row['id'] . '">Share Ticket</button></td>'; // Add a Share button
                        echo '</tr>';

                        // Create a modal for viewing ticket
                        echo '<div class="modal fade" id="viewTicketModal' . $row['id'] . '" tabindex="-1" aria-labelledby="viewTicketModalLabel' . $row['id'] . '" aria-hidden="true">';
                        echo '<div class="modal-dialog">';
                        echo '<div class="modal-content">';
                        echo '<div class="modal-header">';
                        echo '<h5 class="modal-title" id="viewTicketModalLabel">Booking Details</h5>';
                        echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                        echo '</div>';
                        echo '<div class="modal-body">';
                        // Include the necessary booking details here
                        echo '<div style="position: relative;">';
                        echo '<img src="assets/images/ticket.png" alt="Image" class="img-fluid mb-3">';
                        echo '<div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 24px; color: white; font-weight: bold;">BACKPACKERS</div>';
                        echo '</div>';

                        echo '<p>Name: ' . $row['name'] . '</p>';
                        echo '<p>Email: ' . $row['email'] . '</p>';
                        echo '<p>Phone: ' . $row['phone'] . '</p>';
                        echo '<p>Tour Date: ' . $row['tour_date'] . '</p>';
                        echo '<p>Ticket Price: ' . $row['amount'] . '</p>';
                        echo '</div>';
                        echo '<div class="modal-footer">';
                        echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        
                        echo '</div>';

                        // Create a modal for sharing ticket
                        echo '<div class="modal fade" id="shareTicketModal' . $row['id'] . '" tabindex="-1" aria-labelledby="shareTicketModalLabel' . $row['id'] . '" aria-hidden="true">';
                        echo '<div class="modal-dialog">';
                        echo '<div class="modal-content">';
                        echo '<div class="modal-header">';
                        echo '<h5 class="modal-title" id="shareTicketModalLabel' . $row['id'] . '">Share Ticket</h5>';
                        echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                        echo '</div>';
                        echo '<div class="modal-body">';
                        echo '<form method="post" action="share_ticket.php">';
                        echo '<div class="mb-3">';
                        echo '<label for="recipient_id' . $row['id'] . '" class="form-label">Recipient\'s User ID:</label>';
                        echo '<input type="text" class="form-control" id="recipient_id' . $row['id'] . '" name="recipient_id" required>';
                        echo '</div>';
                        echo '<input type="hidden" name="ticket_id" value="' . $row['id'] . '">';
                        echo '<button type="submit" name="share_ticket" class="btn btn-primary">Share Ticket</button>';
                        echo '</form>';
                        echo '</div>';
                        echo '<div class="modal-footer">';
                        echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }

                    echo '</tbody>';
                    echo '</table>';
                    echo '</div>';
                } else {
                    echo '<div class="container mt-5">';
                    echo '<h2>No Booking Records Found</h2>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
<style>
    .container-fluid {
        width: 80%;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php include 'inc/footer.php';?>
