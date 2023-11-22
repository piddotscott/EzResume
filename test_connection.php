<?php
$servername = "localhost"; // This is typically the default for XAMPP
$username = "root"; // The default MySQL username for XAMPP
$password = ""; // The default MySQL password for XAMPP
$dbname = "ezresume"; // Your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully!";

// Close the database connection

?>
