<?php
include '../include/db.php';
include '../include/auth.php';
$title = 'Register';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if (registerUser($conn, $username, $password)) {
        header("Location: login.php");
        exit();
    } else {
        echo "Registration failed!";
    }
}

include '../templates/register.php';
?>
