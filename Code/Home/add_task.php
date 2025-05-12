<?php
// Database connection
$servername = "localhost";
$username = "root"; 
$password = "";     
$dbname = "login";   
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

session_start();

// Ensure user is logged in by checking if 'user_id' is in the session
if (!isset($_SESSION['user_id'])) {
    echo "Error: User is not logged in.";
    exit();
}

// Retrieve the user_id from the session
$user_id = $_SESSION['user_id'];

// Check if POST data is set
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data sent by AJAX
    $taskDescription = $_POST['taskDescription'];
    $taskDate = $_POST['taskDate'];  // In format 'YYYY-MM-DD'
    $taskTime = $_POST['taskTime'];  // In format 'HH:MM:SS'
    
    // Combine taskDate and taskTime into a single DATETIME value
    $dueDate = $taskDate . ' ' . $taskTime; // Concatenate date and time
    
    // Insert the task into the database
    $stmt = $con->prepare("INSERT INTO tasks (id_user, description, due_date, status) VALUES (?, ?, ?, ?)");
    $status = 0; // Initial status: 0 for "incomplete"
    $stmt->bind_param("issi", $user_id, $taskDescription, $dueDate, $status);
    
    if ($stmt->execute()) {
        // Get the last inserted task ID (auto-incremented)
        $taskId = $con->insert_id;

        // Return the taskId as the response
        echo $taskId;
    } else {
        echo "Error adding task: " . $stmt->error;
    }

    $stmt->close();
}

$con->close();
?>
