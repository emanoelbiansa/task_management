<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: /login.php");
    exit();
}

include '../include/header.php';
?>

<main>
    <h2>Welcome to Your Task Management System</h2>
    <p>Manage your tasks efficiently. <a href="/public/task.php">View your tasks</a></p>
</main>

<?php
include '../include/footer.php';
?>
