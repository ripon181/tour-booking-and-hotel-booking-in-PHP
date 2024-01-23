<?php
session_start();
include 'connection/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['share_ticket'])) {
    $recipient_id = mysqli_real_escape_string($conn, $_POST['recipient_id']);
    $ticket_id = mysqli_real_escape_string($conn, $_POST['ticket_id']);

   
    $recipient_query = "SELECT * FROM users WHERE id = '$recipient_id'";
    $recipient_result = $conn->query($recipient_query);

    if ($recipient_result->num_rows > 0) {
     
        $insert_query = "INSERT INTO shared_tickets (ticket_id, sender_id, recipient_id, shared_date) VALUES ('$ticket_id', '{$_SESSION['id']}', '$recipient_id', NOW())";
        
        if ($conn->query($insert_query) === TRUE) {
           
            header("Location: myAccount.php"); 
            exit;
        } else {
          
            echo "Error: " . $conn->error;
        }
    } else {
      
        echo "Recipient not found. Please check the user ID.";
    }
} else {
  
    header("Location: myAccount.php");
    exit;
}
?>
