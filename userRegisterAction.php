<?php
include 'connection/config.php';
// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password
    $conpassword = password_hash($_POST["conpassword"], PASSWORD_DEFAULT); // Hash the password

    // SQL query to insert user data into the table
    $sql = "INSERT INTO users (name, email, password,conpassword) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $password,$conpassword);

    if ($stmt->execute()) {
        // Registration successful, redirect to login page
        echo '<script>alert("Registration successful. You can now log in."); window.location.href = "login.php";</script>'; // Change to your login page URL
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
