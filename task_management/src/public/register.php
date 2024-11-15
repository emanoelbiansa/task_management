<?php
$servername = "mysql";
$username = "root";
$password = "root";
$dbname = "db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $user = $_POST['username'];
  $pass = $_POST['password'];
  $confirm_pass = $_POST['confirm_password'];

  // Validate input
  if (empty($user) || empty($pass) || empty($confirm_pass)) {
    die("Please fill in all fields.");
  }
  if ($pass !== $confirm_pass) {
    die("Passwords do not match.");
  }

  // Hash the password for security
  $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

  // Insert into database
  $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $user, $hashed_password);

  if ($stmt->execute()) {
    echo "Registration successful.";
  } else {
    echo "Error: " . $stmt->error;
  }

  $stmt->close();
}

$conn->close();
?>