<?php
include '../include/db.php';
include '../include/auth.php';
$title = 'Login';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if (loginUser($conn, $username, $password)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Login failed!";
    }
}

include '../templates/login.php';
?>
