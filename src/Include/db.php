<?php
// Database connection settings
$host = "localhost";  
$dbname = "db";  
$username = "admin";  
$password = "admin";  

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>