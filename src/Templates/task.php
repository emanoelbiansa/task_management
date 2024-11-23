<?php include '../include/header.php'; ?>

<main>
    <h2>Your Tasks</h2>

    <!-- Form to add new task -->
    <form method="POST" action="/task.php">
        <input type="text" name="task" placeholder="New Task" required>
        <button type="submit">Add Task</button>
    </form>

    <h3>Task List:</h3>
    <ul>
        <?php foreach ($tasks as $task): ?>
            <li>
                <?php echo htmlspecialchars($task['task']); ?> - <?php echo $task['created_at']; ?>
                <a href="?delete=<?php echo $task['id']; ?>">Delete</a>
                <!-- Add Update functionality here if needed -->
            </li>
        <?php endforeach; ?>
    </ul>
</main>

<?php include '../include/footer.php'; ?>
