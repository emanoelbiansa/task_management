<?php
// Database connection settings
$host = "mysql";  
$dbname = "db";  
$username = "root";  
$password = "root";  

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>