<?php
// Include the database connection
include '../include/db.php';
session_start();

// Ensure user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: /login.php");
    exit();
}

// Handle task submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['task'])) {
    $task = $_POST['task'];
    $user_id = $_SESSION['user_id'];  // Assuming user_id is stored in session upon login

    // Prepare and bind the query to insert task into the database
    $stmt = $conn->prepare("INSERT INTO tasks (user_id, task) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $task);
    $stmt->execute();
    $stmt->close();
}

// Fetch tasks for the logged-in user
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT id, task, created_at FROM tasks WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($id, $task, $created_at);

// Collect tasks into an array
$tasks = [];
while ($stmt->fetch()) {
    $tasks[] = [
        'id' => $id,
        'task' => $task,
        'created_at' => $created_at
    ];
}

$stmt->close();
$conn->close();

// Include the template to render the view
include '../templates/task.php';
?>
