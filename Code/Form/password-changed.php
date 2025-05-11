<?php require_once "controllerUserData.php"; ?>
<?php
if($_SESSION['info'] == false){
    header('Location: login-user.php');  
}
?>
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

            div.shadow-sm{
                box-shadow:none!important;
            }

        }
    </style>
</head>
<body class="bg-light">
    <div class="container form-container">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <?php 
                        if(isset($_SESSION['info'])){
                            ?>
                            <div class="alert alert-success text-center">
                                <?php echo $_SESSION['info']; ?>
                            </div>
                            <?php
                        }
                        ?>
                        <form action="login-user.php" method="POST">
                            <div class="form-group">
                                <input class="btn btn-primary btn-block" type="submit" name="login-now" value="Login Now">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
