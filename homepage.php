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
	<title>Home page</title>
	<link rel="stylesheet" href="style_for_homepage.css">

      <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer">

</head>
<body>

<div class="container_navbar">
  <div class="navbar">
    <div class="icon_sidebar">
       <div class="one"></div>
       <div class="two"></div>
       <div class="three"></div>
    </div>
    <div class="welcome">
      <div class="logo">
        <img src="images/LOGO.png">
        <p>logo</p>
    </div>
     <ul>
        <p>Username</p>
        <li>
          <a href="#">
            <i class="fas fa-user"></i>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fas fa-bell"></i>
          </a>
        </li>
        <li>
          <a href="logout.php">
          <i class="fa-solid fa-right-from-bracket"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>
  
  <div class="sidebar">
      <ul>
        <li><a href="#">
          <span class="icon"><i class="fas fa-book"></i></span>
          <span class="title">Books</span></a></li>
        <li><a href="#">
          <span class="icon"><i class="fas fa-file-video"></i></span>
          <span class="title">Movies</span>
          </a></li>
        <li><a href="#">
          <span class="icon"><i class="fas fa-volleyball-ball"></i></span>
          <span class="title">Sports</span>
          </a></li>
        <li><a href="#" class="active">
          <span class="icon"><i class="fas fa-blog"></i></span>
          <span class="title">Blogs</span>
          </a></li>
        <li><a href="#">
          <span class="icon"><i class="fas fa-leaf"></i></span>
          <span class="title">Nature</span>
          </a></li>
    </ul>
  </div>
  
  <div class="main_container">
    <div class="task">
            task1
    </div>
  </div>
</div>
	
</body>
</html>
