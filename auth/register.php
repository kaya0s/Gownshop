<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
            <title>HJ Gownshop | Create an account</title>
            <link rel="icon" type="image/png" href="../assets/images/HJ Logo.png">
            <link rel="stylesheet" href="../assets/css/login.css">
            <script src="../assets/js/login.js"></script>
    </head>
    <body>
       <div class="main_container">

        <div class="login_container">
            <div class="card">
                <img src="../assets/images/HJ Logo.png "  alt="This is a logo" style="margin-bottom: -20px; width: 200px; ">

                <form action="validateLogin.php" method="POST">
                <h1 style="color: black; margin-bottom: -10px;">Welcome to HJ Gowns</h1>
                <h3 style="color: black; text-align: center; ">Create an Account</h3>
                    <div class="input-group" >
                        <img src="../assets/images/user (1).png" alt="Username icon" class="input-icon">
                        <input type="text" placeholder="firstname" name="firstname" >
                    </div>
                    <div class="input-group" >
                            <img src="../assets/images/user (1).png" alt="Username icon" class="input-icon">
                            <input type="text" placeholder="lastname" name="lastname" >
                    </div>  
                    <div class="input-group" >
                        <img src="../assets/images/user (1).png" alt="Username icon" class="input-icon">
                        <input type="text" placeholder="Username" name="username" >
                    </div>
                    <div class="input-group" >
                        <img src="../assets/images/user (1).png" alt="Username icon" class="input-icon">
                        <input type="text" placeholder="Email" name="email" >
                    </div>  
                    
                    <div class="input-group" >
                         <img src="../assets/images/user (1).png" alt="Username icon" class="input-icon">
                        <input type="text" placeholder="Phone Number " name="phone" >
                    </div>     
                    <div class="input-group" >
                         <img src="../assets/images/user (1).png" alt="Username icon" class="input-icon">
                        <input type="text" placeholder="Address" name="address" >
                    </div> 
                        <div class="input-group">
                            <img src="../assets/images/padlock.png" alt="Password icon" class="input-icon">
                            <input type="password" placeholder="Password" name="password" id="passwordInput">
                            <img src="../assets/images/HJ Logo.png" alt="Show Password" class="password-icon" id="hidePassword">
                            <img src="../assets/images/HJ Logo.png" alt="Hide Password" class="password-icon" id="showPassword">
                        </div>
                        <button class="login-btn" type="submit" value="signup"  name="signup" >Sign up</button>
                        
                            <p class="errormsg"> <?php
                            if(isset($_SESSION['signupmsg']))
                             echo htmlspecialchars($_SESSION['signupmsg']); unset($_SESSION['signupmsg']); ?>
                           
                             </p>
                        <p>already have an account? <a href="../index.php">Log in</a></p>
                </form>
            </div>
        </div>

        <div class="video_container">
            <!-- <h1>this is video video conrtainer</h1> -->
        </div>

       </div>

    </body>
</html>