<?php

session_start();
require_once '../includes/connection_db.php';

$firstname= $_POST['firstname'];
$lastname= $_POST['lastname'];
$username= $_POST['username'];
$email= $_POST['email'];
$password = $_POST['password'];
$repassword = $_POST['repassword'];

$password = password_hash($password,PASSWORD_DEFAULT);

    
    if($_SERVER['REQUEST_METHOD']== "POST" && isset($_POST['add-admin'])){
    
        if($password != $repassword){
            $_SESSION['adminmsg'] = "password dont match";
            header("location: dashboard.php");
            exit();
        }

        $stmt = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' OR email='$email'");

        if(mysqli_num_rows($stmt) > 0){
             $_SESSION['adminmsg'] = "account already exist";
            header("location: dashboard.php");
            exit();
        }else{

            $stmt = mysqli_query($conn, "INSERT INTO users (firstname, lastname, username, email, password, user_type) VALUES ('$firstname', '$lastname', '$username', '$email', '$password', 'admin')");
            if($stmt){
                $_SESSION['adminmsg'] = "Successfully created an admin";
                header("location: dashboard.php");
                exit();
             }

        }
        
    }



?>

