<!DOCTYPE html>
<html>
    <head>
        <title>HJ Gownshop</title>
        
        <script src="assets/js/login.js"></script>
        <link rel="icon" type="image/png" href="assets/images/HJ Logo.png">
        <link rel="stylesheet" href="assets/css/login.css">
        <script src="assets/js/login.js"></script>
    </head>
    <body>
    
    <?php require('includes/alertmsg.php');?>  

        <div class="main_container"  >
            <div class="login_container" style="background-color:whitesmoke;" >
                <div class="card">
                    <img src="assets/images/HJ Logo.png" alt="This is a logo"    >

                    <form action="auth/validateLogin.php" method="POST">
                        <h1>Welcome to HJ Gowns</h1>
                        <h3>Let's get you started!</h3>

                        <!-- email input -->
                        <div class="input-group">
                            <img src="assets/images/user (1).png" alt="Username icon" class="input-icon">
                            <input type="text" placeholder="username or email" name="username">
                        </div>

                        <!-- password input -->
                        <div class="input-group">
                            <img src="assets/images/padlock.png" alt="Password icon" class="input-icon">
                            <input type="password" placeholder="Password" name="password" id="passwordInput">
                            <img src="assets/images/eye.png" alt="Show Password" class="password-icon" id="hidePassword">
                            <img src="assets/images/hidden.png" alt="Hide Password" class="password-icon" id="showPassword">
                        </div>
                            <button class="login-btn" type="submit" value="login"  name="login" >Log in</button>
                            
                            <p class="errormsg"> <?php
                            // require_once('auth/validateLogin.php');
                            if(isset($_SESSION['loginmsg']))
                             echo htmlspecialchars($_SESSION['loginmsg']);unset($_SESSION['loginmsg']); ?>
                             </p>
                            <p><a href="auth/forgotpassword/forgot-password.php">Forgot Password?</a></p>

                        <p>Don't have an account? <a href="auth/register.php">Sign up</a></p>
                        
                       
                    </form>
                </div>
            </div>
            <div class="video_container">
                <!-- <h1>This is video container</h1> -->
                <div class="form-box">

            </div>
            </div>
        </div>
     </body>
</html>