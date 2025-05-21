<?php
    session_start();
    
    if(!isset($_SESSION['email'])){
        header("location: ../../index.php");
        exit();
    }
    
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
            mysqli_query($conn, $query);
            
            $_SESSION['successmsg'] = "Password changed successfully! You can now login with your new password.";
            header("location: ../../index.php");
           
            exit();
        }
        

    }

   
?>

<!DOCTYPE html>
<html>
    <head>
        <title>HJ Gownshop | New Password</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="../../assets/images/HJ Logo.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../../assets/css/index.css">
    </head>
    <body>
        <div class="main_container">
            <div class="login_container">
                <div class="card">
                    <img src="../../assets/images/HJ Logo.png" class="logo" alt="HJ Gownshop Logo">
                    <form action="new-password.php" method="POST">
                        <h1>Create New Password</h1>
                        <h3>Please enter your new password</h3>

                        <div class="input-group">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" placeholder="New Password" name="password" id="passwordInput" minlength="8" required>
                            <i class="fas fa-eye password-icon" id="showPassword"></i>
                            <i class="fas fa-eye-slash password-icon" id="hidePassword" style="display: none;"></i>
                        </div>

                        <div class="input-group">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" placeholder="Confirm New Password" name="repassword" id="confirmPasswordInput" minlength="8" required>
                            <i class="fas fa-eye password-icon" id="showConfirmPassword"></i>
                            <i class="fas fa-eye-slash password-icon" id="hideConfirmPassword" style="display: none;"></i>
                        </div>

                        <button class="login-btn" type="submit" name="change">Change Password</button>

                        <div class="errormsg">
                            <?php 
                            if(isset($_SESSION['error'])) { 
                                echo htmlspecialchars($_SESSION['error']); 
                                unset($_SESSION['error']); 
                            }
                            ?>
                        </div>

                        <div class="links">
                            <p>Remember your password? <a href="../../index.php">Sign in</a></p>
                        </div>
                    </form>
                </div>
            </div>

            <div class="video-container">
                <video autoplay muted loop>
                    <source src="../../assets/videos/gown.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>

        <script>
            // Password visibility toggle for new password
            const passwordInput = document.getElementById('passwordInput');
            const showPassword = document.getElementById('showPassword');
            const hidePassword = document.getElementById('hidePassword');

            showPassword.addEventListener('click', () => {
                passwordInput.type = 'text';
                showPassword.style.display = 'none';
                hidePassword.style.display = 'block';
            });

            hidePassword.addEventListener('click', () => {
                passwordInput.type = 'password';
                hidePassword.style.display = 'none';
                showPassword.style.display = 'block';
            });

            // Password visibility toggle for confirm password
            const confirmPasswordInput = document.getElementById('confirmPasswordInput');
            const showConfirmPassword = document.getElementById('showConfirmPassword');
            const hideConfirmPassword = document.getElementById('hideConfirmPassword');

            showConfirmPassword.addEventListener('click', () => {
                confirmPasswordInput.type = 'text';
                showConfirmPassword.style.display = 'none';
                hideConfirmPassword.style.display = 'block';
            });

            hideConfirmPassword.addEventListener('click', () => {
                confirmPasswordInput.type = 'password';
                hideConfirmPassword.style.display = 'none';
                showConfirmPassword.style.display = 'block';
            });
        </script>
    </body>
</html>