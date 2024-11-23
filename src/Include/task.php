<?php
// Include the database connection
include 'db.php';

/**
 * Create a new task
 * 
 * @param int $user_id - The ID of the user creating the task
 * @param string $task - The task description
 * @return bool - Returns true if task is created, false otherwise
 */
function createTask($user_id, $task) {
    global $conn;

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO tasks (user_id, task) VALUES (?, ?)");
    if ($stmt === false) {
        die('MySQL prepare error: ' . $conn->error);
    }
    
    $stmt->bind_param("is", $user_id, $task);  // 'i' = integer, 's' = string

    // Execute the query
    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $stmt->close();
        return false;
    }
}

/**
 * Read tasks for a specific user
 * 
 * @param int $user_id - The ID of the user to fetch tasks
 * @return array - An array of tasks for the user
 */
function getTasks($user_id) {
    global $conn;
    $tasks = [];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT id, task, created_at FROM tasks WHERE user_id = ?");
    if ($stmt === false) {
        die('MySQL prepare error: ' . $conn->error);
    }
    
    $stmt->bind_param("i", $user_id);  // 'i' = integer
    
    // Execute the query
    if ($stmt->execute()) {
        $stmt->bind_result($id, $task, $created_at);
        
        // Fetch tasks
        while ($stmt->fetch()) {
            $tasks[] = ['id' => $id, 'task' => $task, 'created_at' => $created_at];
        }
        $stmt->close();
    }

    return $tasks;
}

/**
 * Update a task
 * 
 * @param int $task_id - The task ID to update
 * @param string $task - The updated task description
 * @return bool - Returns true if task is updated, false otherwise
 */
function updateTask($task_id, $task) {
    global $conn;

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE tasks SET task = ? WHERE id = ?");
    if ($stmt === false) {
        die('MySQL prepare error: ' . $conn->error);
    }
    
    $stmt->bind_param("si", $task, $task_id);  // 's' = string, 'i' = integer

    // Execute the query
    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $stmt->close();
        return false;
    }
}

/**
 * Delete a task
 * 
 * @param int $task_id - The task ID to delete
 * @return bool - Returns true if task is deleted, false otherwise
 */
function deleteTask($task_id) {
    global $conn;

    // Prepare and bind
    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
    if ($stmt === false) {
        die('MySQL prepare error: ' . $conn->error);
    }
    
    $stmt->bind_param("i", $task_id);  // 'i' = integer

    // Execute the query
    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $stmt->close();
        return false;
    }
}
?>
