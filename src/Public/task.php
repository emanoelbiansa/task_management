<?php
include '../include/task.php';  // Include task functions
include '../include/db.php';    // Database connection

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /login.php");
    exit();
}

// Handle the creation of a task
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['task'])) {
    $task = $_POST['task'];
    if (createTask($_SESSION['user_id'], $task)) {
        echo "Task created successfully!";
    } else {
        echo "Failed to create task.";
    }
}

// Handle task deletion
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $task_id = $_GET['delete'];
    if (deleteTask($task_id)) {
        echo "Task deleted successfully!";
    } else {
        echo "Failed to delete task.";
    }
}

// Fetch all tasks for the logged-in user
$tasks = getTasks($_SESSION['user_id']);

include '../templates/task.php';
?>

