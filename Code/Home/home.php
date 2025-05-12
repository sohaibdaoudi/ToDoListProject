<?php 
session_start();
require "connection.php";
$email = $_SESSION['email'];
$password = $_SESSION['password'];

// Ensure the user is logged in and get the name of user
if($email != false && $password != false){
  $sql = "SELECT * FROM usertable WHERE email = '$email'";
  $run_Sql = mysqli_query($con, $sql);
  if($run_Sql){
      $fetch_info = mysqli_fetch_assoc($run_Sql);
      $name = $fetch_info['name'];
      $user_id = $fetch_info['user_id'];
      $_SESSION['user_id'] = $user_id;
  }
}else{
  header('Location: login-user.php');
  exit();
}

// Fetch tasks with different statuses
$sql_status0 = "SELECT * FROM tasks WHERE id_user = $user_id AND status = 0";
$status0 = mysqli_query($con, $sql_status0);

$sql_status1 = "SELECT * FROM tasks WHERE id_user = $user_id AND status = 1";
$status1 = mysqli_query($con, $sql_status1);

$sql_status_minus1 = "SELECT * FROM tasks WHERE id_user = $user_id AND status = -1";
$status_minus1 = mysqli_query($con, $sql_status_minus1);

// Fetch tasks for today's date (ignoring the time part)
$sql_today = "SELECT * FROM tasks WHERE id_user = $user_id AND DATE(due_date) = CURDATE() AND status = 0";
$today_tasks = mysqli_query($con, $sql_today);


// Fetch important tasks
$sql_important = "SELECT * FROM tasks WHERE id_user = $user_id AND important = 1 AND status = 0";
$important_tasks = mysqli_query($con, $sql_important);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style_home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<body>

<div class="container">
  <div class="navbar">
    <div class="icon_sidebar">
       <div class="one"></div>
       <div class="two"></div>
       <div class="three"></div>
    </div>
    <div class="welcome">
      <div class="logo">
        <img src="../images/LOGO.png">
        <p>Do It</p>
    </div>
     <ul>
        <p><?php echo htmlspecialchars($name);?></p>
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
          <a href="logout-user.php">
          <i class="fa-solid fa-right-from-bracket"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>
  
  <div class="sidebar" id="sidebar">
      <ul>
        <li><a href="#" id="myDayMenu">
          <span class="icon"><i class="fa-solid fa-calendar-day"></i></span>
          <span class="title">My day</span></a></li>
        <li><a href="#" id="importantMenu">
          <span class="icon"><i class="fa-regular fa-star"></i></span>
          <span class="title">Important</span>
          </a></li>
        <li><a href="#" id="tasksMenu">
          <span class="icon"><i class="fa-solid fa-list-check"></i></span>
          <span class="title">Tasks</span>
          </a></li>
    </ul>
  </div>
  
  <div class="main_container">

    <!-- My Day Section -->
<div id="myDaySection" class="content-section" style="display: block;">
  <div class="first-line">
    <div class="datetime">
      <h1 style="font-weight:normal">My Day</h1>
      <div class="date">
        <?php echo date("l, F j, Y"); ?> <!-- Display current date -->
      </div>
      <div class="time">
        <?php echo date("h:i A"); ?> <!-- Display current time -->
      </div>
    </div>
  </div>

  <div class="task_list" id="taskList">
      <?php while($row = mysqli_fetch_assoc($today_tasks)): ?>
          <div class="task <?php echo $row['important'] ? 'important' : ''; ?>" data-task-id="<?php echo htmlspecialchars($row['id']); ?>">
              <div class="task-header">
                  <!-- Star button to toggle importance -->
                  <button class="star-button" onclick="toggleImportant(<?php echo $row['id']; ?>)">
                      <i class="fa-regular fa-star star <?php echo $row['important'] ? 'important' : ''; ?>"></i>
                  </button>
                  <p><?php echo htmlspecialchars($row['description']); ?></p>
              </div>

              <?php if ($row['due_date'] !== '0000-00-00 00:00:00'): ?>
                  <p><?php echo htmlspecialchars(substr($row['due_date'], 0, 10)); ?></p>
                  <p><?php echo htmlspecialchars(substr($row['due_date'], 11, 5)); ?></p>
              <?php endif; ?>

              <div>
                  <button class="complete" onclick="updateTaskStatus(<?php echo $row['id']; ?>, 1)">Completed</button>
                  <button class="dismiss" onclick="updateTaskStatus(<?php echo $row['id']; ?>, -1)">Dismissed</button>
              </div>
          </div>
      <?php endwhile; ?>
    </div>
  </div>

    
    <!-- Important Section -->
    <div id="importantSection" class="content-section" style="display: none;">
      <h1>Important</h1>

      <div class="task_list" id="importantTaskList">
        <?php while($row = mysqli_fetch_assoc($important_tasks)): ?>
            <div class="task <?php echo $row['important'] ? 'important' : ''; ?>" data-task-id="<?php echo htmlspecialchars($row['id']); ?>">
                <div class="task-header">
                    <!-- Star button to toggle importance -->
                    <button class="star-button" onclick="toggleImportant(<?php echo $row['id']; ?>)">
                        <i class="fa-regular fa-star star <?php echo $row['important'] ? 'important' : ''; ?>"></i>
                    </button>
                    <p><?php echo htmlspecialchars($row['description']); ?></p>
                </div>
        
                <?php if ($row['due_date'] !== '0000-00-00 00:00:00'): ?>
                    <p><?php echo htmlspecialchars(substr($row['due_date'], 0, 10)); ?></p>
                    <p><?php echo htmlspecialchars(substr($row['due_date'], 11, 5)); ?></p>
                <?php endif; ?>
                
                <div>
                    <button class="complete" onclick="updateTaskStatus(<?php echo $row['id']; ?>, 1)">Completed</button>
                    <button class="dismiss" onclick="updateTaskStatus(<?php echo $row['id']; ?>, -1)">Dismissed</button>
                </div>
            </div>
        <?php endwhile; ?>
      </div>
    </div>



    <!-- Tasks Section -->
    <div id="tasksSection" class="content-section" style="display: none;">
      <div class="task_input">
        <input type="text" id="taskInput" placeholder="Add a new task..." />
        <button id="addTaskButton">Add</button>
      </div>
      
      <div class="time_data" style="display: none;">
        <input type="date" id="taskDate" />
        <input type="time" id="taskTime" />
      </div>

      <!-- Pending tasks -->
      <div class="task_list" id="taskList">
          <?php while($row = mysqli_fetch_assoc($status0)): ?>
              <!-- Add the 'important' class to the task div if important = 1 -->
              <div class="task <?php echo $row['important'] ? 'important' : ''; ?>" data-task-id="<?php echo htmlspecialchars($row['id']); ?>">
                  <div class="task-header">
                      <!-- Star button to toggle importance -->
                      <button class="star-button" onclick="toggleImportant(<?php echo $row['id']; ?>)">
                          <i class="fa-regular fa-star star <?php echo $row['important'] ? 'important' : ''; ?>"></i>
                      </button>
                      <p><?php echo htmlspecialchars($row['description']); ?></p>
                  </div>
          
                  <?php if ($row['due_date'] !== '0000-00-00 00:00:00'): ?>
                      <p><?php echo htmlspecialchars(substr($row['due_date'], 0, 10)); ?></p>
                      <p><?php echo htmlspecialchars(substr($row['due_date'], 11, 5)); ?></p>
                  <?php endif; ?>
                  
                  <div>
                      <button class="complete" onclick="updateTaskStatus(<?php echo $row['id']; ?>, 1)">Completed</button>
                      <button class="dismiss" onclick="updateTaskStatus(<?php echo $row['id']; ?>, -1)">Dismissed</button>
                  </div>
              </div>
          <?php endwhile; ?>
      </div>



      
      <!-- Completed tasks -->
      <h3 class="collapsible">Completed Tasks</h3>
      <div class="completed_list" id="completedList">
          <?php while($row = mysqli_fetch_assoc($status1)): ?>
              <div class="task">
                  <p><?php echo htmlspecialchars($row['description']); ?></p>
                  <?php if ($row['due_date'] !== '0000-00-00 00:00:00'): ?>
                      <p><?php echo htmlspecialchars(substr($row['due_date'], 0, 10)); ?></p>
                      <p><?php echo htmlspecialchars(substr($row['due_date'], 11, 5)); ?></p>
                  <?php endif; ?>
              </div>
          <?php endwhile; ?>
      </div>
      
      <!-- Dismissed tasks -->
      <h3 class="collapsible">Dismissed Tasks</h3>
      <div class="dismissed_list" id="dismissedList">
          <?php while($row = mysqli_fetch_assoc($status_minus1)): ?>
              <div class="task">
                  <p><?php echo htmlspecialchars($row['description']); ?></p>
                  <?php if ($row['due_date'] !== '0000-00-00 00:00:00'): ?>
                      <p><?php echo htmlspecialchars(substr($row['due_date'], 0, 10)); ?></p>
                      <p><?php echo htmlspecialchars(substr($row['due_date'], 11, 5)); ?></p>
                  <?php endif; ?>
              </div>
          <?php endwhile; ?>
      </div>
    </div>
  </div>
</div>

<script src="homepage.js">
    
</script>


</body>
</html>

