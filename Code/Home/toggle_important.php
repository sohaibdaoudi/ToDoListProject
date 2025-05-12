<?php
// Include the database connection
require 'connection.php';

// Set content type to JSON
header('Content-Type: application/json');

// Check if taskId is set and valid
if (isset($_POST['taskId']) && is_numeric($_POST['taskId'])) {
    $taskId = intval($_POST['taskId']);
    
    // Fetch current status
    $stmt = $con->prepare("SELECT important FROM tasks WHERE id = ?");
    $stmt->bind_param("i", $taskId);
    $stmt->execute();
    $result = $stmt->get_result();
    $task = $result->fetch_assoc();

    if ($task) {
        // Toggle the important status
        $newStatus = $task['important'] ? 0 : 1;
        $updateStmt = $con->prepare("UPDATE tasks SET important = ? WHERE id = ?");
        $updateStmt->bind_param("ii", $newStatus, $taskId);
        $updateStmt->execute();
        
        // Send success response with the new status
        echo json_encode(['success' => true, 'important' => $newStatus]);
    } else {
        // Task not found
        echo json_encode(['success' => false, 'message' => 'Task not found']);
    }
} else {
    // Invalid task ID
    echo json_encode(['success' => false, 'message' => 'Invalid task ID']);
}
