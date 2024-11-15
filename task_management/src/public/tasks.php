<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

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

// Add task
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['task'])) {
    $task = $_POST['task'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO tasks (user_id, task) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $user_id, $task);
    $stmt->execute();
    $stmt->close();
}

// Delete task
if (isset($_GET['delete'])) {
    $task_id = $_GET['delete'];

    $sql = "DELETE FROM tasks WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $task_id);
    $stmt->execute();
    $stmt->close();
}

// Fetch tasks
$user_id = $_SESSION['user_id'];
$sql = "SELECT id, task FROM tasks WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$tasks = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Tasks</title>
    <link rel="stylesheet" href="tasks.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Halo, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
        <h2>Silahkan masukkan tugas baru anda!</h2>
        <form method="post" action="tasks.php">
            <input type="text" name="task" placeholder="Tugas Baru" required>
            <button type="submit">Tambah</button>
        </form>
        <ul>
            <?php foreach ($tasks as $task): ?>
                <li>
                    <?php echo htmlspecialchars($task['task']); ?>
                    <a href="tasks.php?delete=<?php echo $task['id']; ?>">Delete</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </main>
</body>
</html>