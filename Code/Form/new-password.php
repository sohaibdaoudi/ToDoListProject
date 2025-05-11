<?php require_once "controllerUserData.php"; ?>
<?php 
$email = $_SESSION['email'];
if($email == false){
  header('Location: login-user.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a New Password</title>
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
            <div class="col-12 col-sm-9 col-md-8 col-lg-6 form login-form">
                    <form action="new-password.php" method="POST" autocomplete="off">
                        <h2 class="text-center">New Password</h2>
                        <p class="text-center text-muted">Update your password</p>
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
                            <input class="form-control" type="password" name="password" placeholder="Create new password" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="password" name="cpassword" placeholder="Confirm your password" required>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary w-100" type="submit" name="change-password" value="Change">
                        </div>
                    </form>
            </div>
        </div>
    </div>
</body>
</html>
