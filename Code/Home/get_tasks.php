<?php
session_start();
require "connection.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Not authenticated']);
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch tasks for the user
$sql = "SELECT * FROM tasks WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$tasks = [];
while ($row = $result->fetch_assoc()) {
    $tasks[] = [
        'id' => $row['task_id'],
        'text' => $row['task_text'],
        'status' => $row['status'],
        'due_date' => $row['due_date'],
    ];
}

echo json_encode($tasks);
$stmt->close();
?>