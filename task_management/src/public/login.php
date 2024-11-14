<?php
session_start();
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

    // Validate input
    if (empty($user) || empty($pass)) {
        header("Location: login.html?error=emptyfields");
        exit();
    }

    // Fetch user from database
    $sql = "SELECT id, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        header("Location: login.html?error=usernotfound");
        exit();
    }

    $stmt->bind_result($id, $hashed_password);
    $stmt->fetch();

    // Verify password
    if (password_verify($pass, $hashed_password)) {
        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $user;
        header("Location: tasks.php");
        exit(); // Ensure script stops after redirect
    } else {
        header("Location: login.html?error=wrongpassword");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
