<?php 

include 'connect.php';

if(isset($_POST['signUp'])){
    $firstName=$_POST['fName'];
    $lastName=$_POST['lName'];
    $email=$_POST['email'];
    $key = '0123456789abcdef';
    $iv = '1234567890abcdef'; 
    $password=$_POST['password'];
    $password=openssl_encrypt($password, 'aes-128-cbc', $key, 0, $iv); // just an for example we used this 2-way function (encrepy-decrept), for the password we need to use a 1 way function like md5()
    $security_code = $_POST['scode'];

     $checkEmail="SELECT * From users where email='$email'";
     $result=$conn->query($checkEmail);
     if($result->num_rows>0){
        echo "Email Address Already Exists !";
     }
     else{
        $insertQuery="INSERT INTO users(firstName,lastName,email,password,security_code)
                       VALUES ('$firstName','$lastName','$email','$password','$security_code')";
            if($conn->query($insertQuery)==TRUE){
                header("location: index.html");
            }
            else{
                echo "Error:".$conn->error;
            }
     }
   

}

if(isset($_POST['signIn'])){
   $email=$_POST['email'];
   $password=$_POST['password'];
   $password=md5($password) ;
   
   $sql="SELECT * FROM users WHERE email='$email' and password='$password'";
   $result=$conn->query($sql);
   if($result->num_rows>0){
    session_start();
    $row=$result->fetch_assoc();
    $_SESSION['email']=$row['email'];
    header("Location: homepage.php");
    exit();
   }
   else{
    echo "Not Found, Incorrect Email or Password";
   }

}


if (isset($_POST['recPswd'])) {
    $email = $_POST['email'];
    $scode = $_POST['scode'];

    
    $sql = "SELECT * FROM users WHERE email='$email' AND security_code='$scode'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $key = '0123456789abcdef';
        $iv = '1234567890abcdef'; 
        $password = openssl_decrypt($row['password'], 'aes-128-cbc', $key, 0, $iv);

        
        echo "Your password is: $password";
    } else {
        echo "Incorrect email or security code.";
    }
}

?>
