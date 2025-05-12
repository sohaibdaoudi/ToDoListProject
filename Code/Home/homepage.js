// start for get time

const timeElement = document.querySelector(".time");
const dateElement = document.querySelector(".date");

function formatTime(date) {
  const hours12 = date.getHours() % 12 || 12;
  const minutes = date.getMinutes();
  const isAm = date.getHours() < 12;

  return `${hours12.toString().padStart(2, "0")}:${minutes
    .toString()
    .padStart(2, "0")} ${isAm ? "AM" : "PM"}`;
}

function formatDate(date) {
  const DAYS = [
    "Sunday",
    "Monday",
    "Tuesday",
    "Wednesday",
    "Thursday",
    "Friday",
    "Saturday"
  ];
  const MONTHS = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December"
  ];

  return `${DAYS[date.getDay()]}, ${
    MONTHS[date.getMonth()]
  } ${date.getDate()} ${date.getFullYear()}`;
}

setInterval(() => {
  const now = new Date();

  timeElement.textContent = formatTime(now);
  dateElement.textContent = formatDate(now);
}, 200);

// end for get time


//for sidebar collapse
  document.addEventListener('DOMContentLoaded', () => {
    const iconSidebar = document.querySelector('.icon_sidebar');
    const containerNavbar = document.querySelector('.container');

    iconSidebar.addEventListener('click', () => {
      containerNavbar.classList.toggle('collapse');
    });
  });


// for tasks
document.addEventListener('DOMContentLoaded', () => {
  const taskInput = document.getElementById('taskInput');
  const addTaskButton = document.getElementById('addTaskButton');
  const taskList = document.getElementById('taskList'); // Existing PHP-generated tasks will already be in the DOM, so you can manipulate them or append new ones here.
  const completedList = document.getElementById('completedList');
  const dismissedList = document.getElementById('dismissedList');
  const dateInput = document.getElementById('taskDate');
  const timeInput = document.getElementById('taskTime');
  const timeData = document.querySelector('.time_data');

  // Make sections collapsible
  const collapsibleHeaders = document.querySelectorAll('.collapsible');
  collapsibleHeaders.forEach(header => {
    header.addEventListener('click', () => {
      const nextElement = header.nextElementSibling;
      header.classList.toggle('active');
      nextElement.style.display = nextElement.style.display === 'none' || !nextElement.style.display ? 'block' : 'none';
    });
  });

  // Function to update task status via AJAX
// Function to update task status via AJAX and move it to the correct list
const updateTaskStatus = (taskId, status) => {
  const formData = new FormData();
  formData.append('taskId', taskId);
  formData.append('status', status);

  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'completed_dismissed.php', true);
  xhr.onload = function () {
    if (xhr.status === 200) {
      console.log(xhr.responseText);

      // Find the task element in the DOM
      const taskElement = document.querySelector(`[data-task-id="${taskId}"]`);
      if (taskElement) {
        // Remove the task from its current list
        taskElement.remove();

        // Create a clone of the task without buttons
        const taskClone = taskElement.cloneNode(true);
        const buttons = taskClone.querySelectorAll('button');
        buttons.forEach(button => button.remove());

        // Append the task to the correct list based on status
        if (status === 1) {
          completedList.appendChild(taskClone); // Completed tasks
        } else if (status === -1) {
          dismissedList.appendChild(taskClone); // Dismissed tasks
        }
      }
    } else {
      alert('Error: ' + xhr.status);
    }
  };
  xhr.send(formData);
};

// Function to toggle the "important" status of a task
const toggleImportant = (taskId) => {
  const formData = new FormData();
  formData.append('taskId', taskId);

  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'toggle_important.php', true); // A PHP file to handle the toggle logic

  // Handle the response when the request completes
  xhr.onload = function () {
    if (xhr.status === 200) {
      try {
        // Try to parse the response JSON
        const response = JSON.parse(xhr.responseText);

        // Check if the operation was successful
        if (response.success) {
          // Toggle the 'important' class on the task element
          const taskElement = document.querySelector(`[data-task-id="${taskId}"]`);
          if (taskElement) {
            taskElement.classList.toggle('important');
            window.location.reload();
          }
        } else {
          // If the operation failed, show the message
          alert('Error: ' + response.message);
        }
      } catch (e) {
        // If parsing the response failed, log the error and show an alert
        console.error('Invalid JSON response:', xhr.responseText);
        alert('Error: Invalid server response.');
      }
    } else {
      // If the HTTP status is not 200 (OK), show an error
      alert('Error: ' + xhr.status);
    }
  };

  // Send the form data to the server
  xhr.send(formData);
};


// Attach the toggleImportant function to the global window object
window.toggleImportant = toggleImportant;

window.updateTaskStatus = updateTaskStatus;

  // Function to create a new task (DOM manipulation)
  const createTask = (taskId, taskText, date, time) => {
    const task = document.createElement('div');
    task.classList.add('task');
    task.setAttribute('data-task-id', taskId); // Set task ID as a data attribute
  
    // Start building the task content
    let taskContent = `
      <div class="task-header">
        <button class="star-button" onclick="toggleImportant(${taskId})">
          <i class="fa-regular fa-star star"></i>
        </button>
        <p>${taskText}</p>
      </div>
    `;
    
    // Append date if not empty
    if (date) {
      taskContent += `<p>${date}</p>`;
    }
    
    // Append time if not empty
    if (time) {
      taskContent += `<p>${time}</p>`;
    }
    
    // Set the task's inner HTML
    task.innerHTML = `
      ${taskContent}
      <div>
        <button class="complete">Completed</button>
        <button class="dismiss">Dismissed</button>
      </div>
    `;
  
    // Add "Completed" functionality
    task.querySelector('.complete').addEventListener('click', () => {
      task.remove();
      const completedTask = task.cloneNode(true);
      completedTask.querySelector('.complete').remove();
      completedTask.querySelector('.dismiss').remove();
      completedTask.querySelector('.star').remove();
      completedList.appendChild(completedTask);
  
      // Update status in the database
      updateTaskStatus(taskId, 1); // 1 for Completed
    });
  
    // Add "Dismissed" functionality
    task.querySelector('.dismiss').addEventListener('click', () => {
      task.remove();
      const dismissedTask = task.cloneNode(true);
      dismissedTask.querySelector('.complete').remove();
      dismissedTask.querySelector('.dismiss').remove();
      dismissedTask.querySelector('.star').remove();
      dismissedList.appendChild(dismissedTask);
  
      // Update status in the database
      updateTaskStatus(taskId, -1); // -1 for Dismissed
    });
  

  
    return task;
  };
  
  

// add when click
  addTaskButton.addEventListener('click', () => {
    const taskText = taskInput.value.trim();
    const date = dateInput.value;
    const time = timeInput.value;
  
    if (taskText === '') {
      alert('Please enter a task!');
      return;
    }
  
    // Send task data to the PHP server via AJAX 
    const formData = new FormData();
    formData.append('taskDescription', taskText);
    formData.append('taskDate', date);
    formData.append('taskTime', time);
  
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'add_task.php', true);
    xhr.onload = function () {
      if (xhr.status === 200) {
        const taskId = xhr.responseText.trim(); // Get the taskId from the response
  
        if (taskId) {
          // If the task was successfully added, create the task in the UI with the generated taskId
          const task = createTask(taskId, taskText, date, time);
          taskList.appendChild(task);
          window.location.reload(true);
          console.log('Task added successfully with ID:', taskId);
  
          // Clear the input fields
          taskInput.value = '';
          dateInput.value = '';
          timeInput.value = '';
        } else {
          alert('Error: Unable to retrieve the task ID.');
        }
      } else {
        alert('Error: ' + xhr.status);
      }
    };
    xhr.send(formData);
  });
  

  // Allow pressing Enter to add a task
  taskInput.addEventListener('keypress', (event) => {
    if (event.key === 'Enter') {
      addTaskButton.click();
    }
  });

  // Show datetime inputs when task input is focused
  taskInput.addEventListener('focus', () => {
    timeData.style.display = 'block';
    taskInput.style.borderBottomLeftRadius = '0';
    addTaskButton.style.borderBottomRightRadius = '0';
  });

});


// Function to check the media query and add/remove the collapse class
function handleResize() {
  const sidebar = document.querySelector('.container');
  const mediaQuery = window.matchMedia('(max-width: 768px)');
  if (mediaQuery.matches) {
    // If the screen size is less than or equal to 768px, add the collapse class
    sidebar.classList.add('collapse');
  } else {
    // Otherwise, remove the collapse class
    sidebar.classList.remove('collapse');
  }
}
// Run the function on page load
handleResize();
// Add an event listener for window resize
window.addEventListener('resize', handleResize);



// In the navbar when u click in icon
document.addEventListener('DOMContentLoaded', () => {
  const myDayMenu = document.getElementById('myDayMenu');
  const importantMenu = document.getElementById('importantMenu');
  const tasksMenu = document.getElementById('tasksMenu');
  const sidebar = document.querySelector('.container');

  const myDaySection = document.getElementById('myDaySection');
  const importantSection = document.getElementById('importantSection');
  const tasksSection = document.getElementById('tasksSection');

  // Less than 768px
  const mediaQuery = window.matchMedia('(max-width: 768px)');

  // Function to display the selected section
  function displaySection(sectionId) {
    myDaySection.style.display = 'none';
    importantSection.style.display = 'none';
    tasksSection.style.display = 'none';

    if (sectionId === 'myDaySection') {
      myDaySection.style.display = 'block';
    } else if (sectionId === 'importantSection') {
      importantSection.style.display = 'block';
    } else if (sectionId === 'tasksSection') {
      tasksSection.style.display = 'block';
    }

    if (mediaQuery.matches) {
      sidebar.classList.add('collapse');
    }

    // Store the currently displayed section in localStorage
    localStorage.setItem('currentSection', sectionId);
  }

  // Add event listeners
  myDayMenu.addEventListener('click', () => displaySection('myDaySection'));
  importantMenu.addEventListener('click', () => displaySection('importantSection'));
  tasksMenu.addEventListener('click', () => displaySection('tasksSection'));

  // Retrieve the current section from localStorage on page load
  const currentSection = localStorage.getItem('currentSection') || 'myDaySection';
  displaySection(currentSection);
});
