<?php
// Database connection settings
$servername = "localhost"; // Change if your database server is different
$username = "root"; // Default username for XAMPP is 'root'
$password = ""; // Default password for XAMPP is empty
$dbname = "login_system"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
