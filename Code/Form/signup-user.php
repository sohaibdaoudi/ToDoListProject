<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
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

        @media (max-width: 315px) {
            #mobile{
                display:block!important;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-12 col-sm-9 col-md-8 col-lg-6 form">
                <img src="../images/LOGO.png" class="logo img-fluid d-block mx-auto mb-3">
                <form action="signup-user.php" method="POST">
                    <h2 class="text-center">Sign up</h2>
                    <p class="text-center text">It's quick and easy.</p>
                    <?php
                    if(count($errors) == 1){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    } elseif(count($errors) > 1) {
                        ?>
                        <div class="alert alert-danger">
                            <?php
                            foreach($errors as $showerror){
                                ?>
                                <li><?php echo $showerror; ?></li>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="text" name="name" placeholder="Full Name" required value="<?php echo $name ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Email Address" required value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="cpassword" placeholder="Confirm Password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="backup_code" placeholder="Create Backup Code" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button btn-primary" type="submit" name="signup" value="Signup">
                    </div>
                    <div class="link login-link text-center d-flex justify-content-between" id="mobile">
                        <span>Already a member?</span> 
                        <a href="login-user.php">Log in</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
