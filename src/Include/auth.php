<?php
session_start();

// Register User
function registerUser($conn, $username, $password) {
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashedPassword);
    return $stmt->execute();
}

// Login User
function loginUser($conn, $username, $password) {
  $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows == 1) {
      $stmt->bind_result($hashedPassword);
      $stmt->fetch();

      if (password_verify($password, $hashedPassword)) {
          $_SESSION['username'] = $username;  // Store user info in session
          return true;
      }
  }
  
  return false;
}


// Check if User is Logged In
function isLoggedIn() {
    return isset($_SESSION['username']);
}

// Logout User
function logoutUser() {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>