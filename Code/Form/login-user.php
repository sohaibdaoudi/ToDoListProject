<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
         @media (max-width: 576px) {
            body,html{
                background-color:white;
            }

            .container .form{
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
            <div class="col-12 col-sm-9 col-md-8 col-lg-6 form login-form crazy">
                <img src="../images/LOGO.png" class="logo img-fluid d-block mx-auto mb-3">
                <form action="login-user.php" method="POST" autocomplete="">
                    <h2 class="text-center">Log in</h2>
                    <p class="text-center text">Enter your credentials to access your account</p>
                    <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Email Address" required value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="link forget-pass text-left"><a href="forgot-password.php">Forgot password?</a></div>
                    <div class="form-group">
                        <input class="form-control button btn-primary" type="submit" name="login" value="Login here">
                    </div>
                    <div class="link login-link text-center d-flex justify-content-between" id="mobile">
                        <span>Don't have an account yet?</span> 
                        <a href="signup-user.php">Sign up</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
