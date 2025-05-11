<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
         @media (max-width: 576px) {
            body,html{
                background-color:white;
            }

            .container .row .form{
                box-shadow:none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-12 col-sm-9 col-md-8 col-lg-6 form">
                <form action="forgot-password.php" method="POST" autocomplete="off">
                    <h2 class="text-center">Forgot Password</h2>
                    <p class="text-center text">
                        Please enter your email address and your backup code to update your password.
                    </p>
                    <?php
                    // Display errors if any
                    if (count($errors) > 0) {
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php 
                            foreach ($errors as $error) {
                                echo $error;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Enter your email address" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="code" placeholder="Enter backup code" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button btn-primary" type="submit" name="check-code" value="Continue">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
