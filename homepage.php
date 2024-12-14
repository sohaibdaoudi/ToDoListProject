<?php
session_start();
include("connect.php");

if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
    <div style="text-align:center; padding:15%;">
      <p style="font-size:50px; font-weight:bold;">
       Hello  
       <?php 
       if ($stmt = mysqli_prepare($conn, "SELECT firstName, lastName FROM users WHERE email = ?")) {
           mysqli_stmt_bind_param($stmt, "s", $email);
           mysqli_stmt_execute($stmt);
           mysqli_stmt_bind_result($stmt, $firstName, $lastName);
           if (mysqli_stmt_fetch($stmt)) {
               echo htmlspecialchars($firstName) . ' ' . htmlspecialchars($lastName);
           }
           mysqli_stmt_close($stmt);
       }
       ?>
      </p>
      <a href="logout.php">Logout</a>
    </div>
</body>
</html>
