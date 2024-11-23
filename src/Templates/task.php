<?php include '../include/header.php'; ?>

<main>
    <h2>Your Tasks</h2>

    <!-- Task Submission Form -->
    <form class="task-form" method="POST" action="../public/task.php">
        <textarea name="task" placeholder="New task..." required></textarea>
        <button type="submit">Add Task</button>
    </form>

    <!-- Display Existing Tasks -->
    <div class="task-list">
        <?php if (!empty($tasks)): ?>
            <?php foreach ($tasks as $task): ?>
                <div class="task">
                    <h3><?php echo htmlspecialchars($task['task']); ?></h3>
                    <small>Created on: <?php echo date('F j, Y, g:i a', strtotime($task['created_at'])); ?></small>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No tasks found. Start by adding a task!</p>
        <?php endif; ?>
    </div>
</main>

<?php include '../include/footer.php'; ?>
