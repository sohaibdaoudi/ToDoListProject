<?php
session_start();
session_unset();
session_destroy();
header('location: ../Form/login-user.php');
?>