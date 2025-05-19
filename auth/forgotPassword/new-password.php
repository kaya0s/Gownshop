<?php
    session_start();
    
    if(isset($_POST['change']) && $_SERVER['REQUEST_METHOD'] =="POST"){
        include('../../includes/connection_db.php');

        if($_POST['password']!= $_POST['repassword']){
            $_SESSION['error'] = "Password do not match";
            header("location: new-password.php");
            exit();
        }
        else{
            $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $query = "UPDATE users SET password = '$hashed_password' WHERE email = '{$_SESSION['email']}'";
    
            usleep(50000);
            $_SESSION['successmsg'] = "Password changed successfully! You can now login with your new password.";
            header("location: ../../index.php");
           
            exit();
        }
        

    }

   
?>

<!DOCTYPE html>
<html>
    <head>
            <title>HJ Gownshop | Create an account</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="icon" type="image/png" href="../assets/images/HJ Logo.png">
            <link rel="stylesheet" href="../../assets/css/login.css">
            <script src="../assets/js/login.js"></script>
    </head>
    <body>
       <div class="main_container" style="background-color: #041623;">

        <div class="login_container">
            <div class="card">
                <img src="../../assets/images/HJ Logo.png "  alt="This is a logo">

                <form action="new-password.php" method="POST">
                <h1 style="color: black; margin-bottom: 10px;">Welcome to HJ Gowns</h1>
                <h3 style="color: black; text-align: center; ">Change Password</h3>
                    
                    <div class="input-group" >
                        
                        
                        <input type="text" placeholder="New Password" name="password" >
                    </div>
                    <div class="input-group" >
                        
                        
                        <input type="text" placeholder="Confirm New Password" name="repassword" >
                    </div> 
                        
                        <button class="login-btn" type="submit" value="signup"  name="change" >Change Password</button>
                        
                            <p class="errormsg"> <?php
                            if(isset($_SESSION['error'])){
                             echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); }?>
                             </p>
      
                        
                </form>
                <p>Don't have an account? <a style="color:rgb(5, 61, 151); margin-left: 6px;" href="pages/signup.php">Sign up</a></p>
            </div>
        </div>

        <div style="background-color: #041623;" class="video_container">
            <!-- <h1>this is video video conrtainer</h1> -->
        </div>

       </div>

    </body>
</html>