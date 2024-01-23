<?php
include '../connection/config.php';


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Hash the password (you should use a stronger hashing method in production)
    $hashed_password = md5($password);

    // Query to check if the user exists
    $sql = "SELECT * FROM admin WHERE email = '$email' AND password = '$hashed_password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Login successful
        // Redirect to the admin dashboard or another page
        header("Location: dashboard.php");
        exit();
    } else {
        // Login failed
        $error_message = "Invalid email or password. Please try again.";
    }
}
?>