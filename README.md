# ToDo-List Web App – Task Management with User Authentication

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](./LICENSE)

**🚧 Project Status: Under Development 🚧**

---

## 📖 Overview

The **ToDo-List Web App** is a simple yet functional PHP-based task manager that enables authenticated users to manage their daily tasks efficiently. The app supports task prioritization, completion tracking, and secure user authentication including password recovery.

This project is designed with modular code organization, clear data flow, and well-documented database structure to facilitate maintenance and extension.

---

## 🛠️ How to Run the Project (using XAMPP)

### 🔁 Option 1: Clone via Git

```bash
git clone https://github.com/sohaibdaoudi/ToDoListProject.git
```

### 📦 Option 2: Download as ZIP

1. Click on the green **Code** button and select **Download ZIP**.
2. Extract the ZIP folder to your `htdocs` directory inside the XAMPP installation.

### 🧩 Setup Steps

1. **Move the folder** `ToDo-List` into `C:/xampp/htdocs/`
2. **Start XAMPP**, and make sure:
   - **Apache** and **MySQL** services are running.
3. Open **phpMyAdmin** at [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
4. **Create a new database** named `login`
5. Import the SQL schema into `login`:
   - Select the `login` database and go to the **SQL** tab.
   - Open the `DataBase/SQL.txt` file from your project directory.
   - Copy all its contents and paste them into the SQL query box.
   - Click **Go** to execute and create the necessary tables.
6. **Configure Database Credentials**:
   - Open `Code/Form/connection.php` and `Code/Home/connection.php`
   - Edit the DB credentials if needed (default: `root` / no password)
7. Access the app in your browser:
   ```
   http://localhost/ToDo-List/Code/Form/login-user.php
   ```

---

## 🔍 System Features

- **User Authentication System**  
  - Sign-up, login, password reset, and logout functionalities.

- **Task Management Dashboard**  
  - Add, delete, mark as completed, and toggle task importance.

- **AJAX-based Interactions**  
  - Dynamic loading and updating of tasks without page reload.

- **Database Integration**  
  - Fully backed by a MySQL schema with MCD/MLD models.

---

## 📂 Project Structure

```
ToDo-List/
├── Code/
│   ├── Form/
│   │   ├── connection.php
│   │   ├── controllerUserData.php
│   │   ├── forgot-password.php
│   │   ├── login-user.php
│   │   ├── new-password.php
│   │   ├── password-changed.php
│   │   ├── signup-user.php
│   │   └── style.css
│   ├── Home/
│   │   ├── add_task.php
│   │   ├── completed_dismissed.php
│   │   ├── connection.php
│   │   ├── get_tasks.php
│   │   ├── home.php
│   │   ├── homepage.js
│   │   ├── logout-user.php
│   │   ├── style_home.css
│   │   └── toggle_important.php
│   └── Images/
│       └── LOGO.png
├── DataBase/
│   ├── MCD.png
│   ├── MLD.txt
│   └── SQL.txt
└── Documentation/
    ├── Manuel Utilisateur.docx
    ├── Presentation.pptx
    └── Rapport.pdf
```

---

## 🧠 Technologies Used

- **Frontend**: HTML, CSS, JavaScript  
- **Backend**: PHP (Procedural)  
- **Database**: MySQL  
- **AJAX**: For real-time UI updates without full reload  

---

## 🔮 Future Enhancements

- [ ] Fix the issue with the **Complete** and **Dismiss** buttons not working properly  
- [ ] Add user profile and session management  
- [ ] Enable due dates and task reminders  
- [ ] Introduce task categories or tags  

---

## 👨‍💻 Authors

- **SOHAIB DAOUDI** – [soh.daoudi@gmail.com](mailto:soh.daoudi@gmail.com)  
- **MAROUANE MAJIDI** – [majidi.marouane0@gmail.com](mailto:majidi.marouane0@gmail.com)  

---

## 📜 License

This project is licensed under the [MIT License](https://opensource.org/licenses/MIT). See the `LICENSE` file for more information.