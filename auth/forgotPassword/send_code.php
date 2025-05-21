<?php
    session_start();
    require_once('../../vendor/autoload.php');
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../../');
    $dotenv->load();

    if(isset($_POST['sendcode'])&&$_SERVER['REQUEST_METHOD'] === "POST"){
        require_once('../../includes/connection_db.php');
        $code = $_POST['code'];
        $query = "SELECT * FROM USERS WHERE email = '{$_SESSION['email']}'";
        $result = mysqli_query($conn,$query);
        if(mysqli_num_rows($result)>0){
            $row = mysqli_fetch_assoc($result);
            if($code == $row['reset_code']){
                header("location: new-password.php");
                exit();
            }else{
                $_SESSION['error'] = "you entered a wrong code";
                header("location: send_code.php");
                exit();
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>HJ Gownshop | Verify Code</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="../../assets/images/HJ Logo.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <link rel="stylesheet" href="../../assets/css/index.css">
        
    </head>
    <body>
        <div class="main_container">
            <div class="login_container">
                <div class="card">
                    <img src="../../assets/images/HJ Logo.png" class="logo" alt="HJ Gownshop Logo">
                    <form action="send_code.php" method="POST">
                        <h1>Verify Your Code</h1>
                        <h3>Enter the verification code sent to your email</h3>

                        <div class="input-group">
                            <i class="fas fa-key input-icon"></i>
                            <input type="text" placeholder="Enter verification code" name="code" required>
                        </div>

                        <button class="login-btn" type="submit" name="sendcode">Verify Code</button>

                        <div class="errormsg">
                            <?php 
                            if(isset($_SESSION['error'])) { 
                                echo htmlspecialchars($_SESSION['error']); 
                                unset($_SESSION['error']); 
                            }
                            ?>
                        </div>

                        <div class="links">
                            <p>Didn't receive the code? <a href="forgot-password.php">Try again</a></p>
                            <p style="margin-top: 10px;">Remember your password? <a href="../../index.php">Sign in</a></p>
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
    </body>
</html>