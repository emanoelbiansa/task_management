<?php
// header.php
session_start();

// Fetch user information if logged in
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Task Management</h1>
            <nav>
                <?php if ($username): ?>
                    <p>Welcome, <?php echo htmlspecialchars($username); ?></p>
                    <a href="/logout.php">Logout</a>
                <?php else: ?>
                    <a href="/login.php">Login</a> | <a href="/register.php">Register</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>
