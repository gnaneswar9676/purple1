<?php
$servername = "localhost";
$username = "root";
$password = "Chandu.11";  // Make sure this is blank or the correct password for root in XAMPP
$dbname = "login_register";  // Ensure this matches your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
