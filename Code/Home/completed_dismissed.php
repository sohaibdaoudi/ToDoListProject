<?php
session_start();
require "connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Get the form data sent by AJAX
$taskId = $_POST['taskId'];
$status = $_POST['status']; // 1 for completed, -1 for dismissed

// Update the task status in the database
$stmt = $con->prepare("UPDATE tasks SET status = ? WHERE id = ?");
$stmt->bind_param("ii", $status, $taskId);

if ($stmt->execute()) {
  echo "Task status updated successfully";
} else {
  echo "Error updating task status: " . $stmt->error;
}


}
?>
