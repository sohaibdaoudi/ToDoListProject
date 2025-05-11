<?php 
session_start();
require "connection.php";
$email = "";
$name = "";
$errors = array();

// If user clicks the signup button
if (isset($_POST['signup'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    $backup_code = mysqli_real_escape_string($con, $_POST['backup_code']);

    // Check if passwords match
    if ($password !== $cpassword) {
        $errors['password'] = "Confirm password not matched!";
    }

    // Check if email already exists
    $email_check = "SELECT * FROM usertable WHERE email = '$email'";
    $res = mysqli_query($con, $email_check);
    if (mysqli_num_rows($res) > 0) {
        $errors['email'] = "Email that you have entered already exists!";
    }

    // Proceed if there are no errors
    if (count($errors) === 0) {
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $insert_data = "INSERT INTO usertable (name, email, password,backup_code)
                        VALUES ('$name', '$email', '$encpass','$backup_code')";

        $data_check = mysqli_query($con, $insert_data);
        if ($data_check) {
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            header('location: ../Home/home.php'); // Directly redirect to home.php
            exit();
        } else {
            $errors['db-error'] = "Failed while inserting data into the database!";
        }
    }
}

  
// If the user clicks the login button
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Check if the email exists in the database
    $check_email = "SELECT * FROM usertable WHERE email = '$email'";
    $res = mysqli_query($con, $check_email);

    if (mysqli_num_rows($res) > 0) {
        $fetch = mysqli_fetch_assoc($res);
        $fetch_pass = $fetch['password'];

        // Verify the entered password with the stored hashed password
        if (password_verify($password, $fetch_pass)) {
            // Set session variables and redirect to home.php
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            header('location: ../Home/home.php'); // Redirect to home.php
            exit();
        } else {
            $errors['email'] = "Incorrect email or password!";
        }
    } else {
        $errors['email'] = "It looks like you're not yet a member! Click on the bottom link to sign up.";
    }
}

// click forget password
if (isset($_POST['check-code'])) {
    // Retrieve user input
    $email = mysqli_real_escape_string($con, $_POST['email']); // Email entered by the user
    $entered_code = mysqli_real_escape_string($con, $_POST['code']); // Backup code entered by the user

    // Check if the email exists in the database
    $check_email = "SELECT * FROM usertable WHERE email = '$email'";
    $run_sql = mysqli_query($con, $check_email);

    if (mysqli_num_rows($run_sql) > 0) {
        $fetch_info = mysqli_fetch_assoc($run_sql);
        $stored_code = $fetch_info['backup_code']; // The backup code stored in the database for this email

        // Check if the entered code matches the stored code
        if ($entered_code == $stored_code) {
            $_SESSION['email'] = $email; // Store the email in session for password reset
            header('Location: new-password.php'); // Redirect to reset password page
            exit();
        } else {
            $errors['code'] = "The backup code is incorrect!";
        }
    } else {
        $errors['email'] = "This email address does not exist!";
    }
}


// if user click changepassword 
if (isset($_POST['change-password'])) {
    // Clear any previous info
    $_SESSION['info'] = "";
    
    // Get user input
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    
    // Check if passwords match
    if ($password !== $cpassword) {
        $errors['password'] = "Confirm password not matched!";
    } else {
        // No errors, proceed with password change
        $email = $_SESSION['email']; // Get the user's email from session
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        
        // Update password in the database
        $update_pass = "UPDATE usertable SET password = '$encpass' WHERE email = '$email'";
        $run_query = mysqli_query($con, $update_pass);
        
        if ($run_query) {
            // Password updated successfully
            $info = "Your password changed. Now you can login with your new password.";
            $_SESSION['info'] = $info;
            header('Location: password-changed.php');
            exit(); // Make sure to exit after redirection
        } else {
            // Error in database update
            $errors['db-error'] = "Failed to change your password!";
        }
    }
}
    
   //if login now button click
    if(isset($_POST['login-now'])){
        header('Location: login-user.php');
    }
?>
