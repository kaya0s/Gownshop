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
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Poppins', sans-serif;
            }

            html, body {
                height: 100%;
            }
            body {
                background: rgb(60, 69, 76);
                min-height: 100vh;
                height: 100vh;
                width: 100vw;
                display: flex;
                align-items: stretch;
                justify-content: stretch;
                color: #fff;
                overflow: hidden;
            }

            .main_container {
                display: flex;
                width: 100vw;
                height: 100vh;
                max-width: none;
                min-height: 0;
                background: #041623;
                overflow: hidden;
                position: relative;
            }

            .login_container {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                z-index: 2;
                width: 100%;
                max-width: 500px;
                padding: 0 20px;
            }

            .card {
                width: 100%;
                text-align: center;
                background: rgba(255, 255, 255, 0.07);
                padding: 40px;
                border: 1px solid rgba(255, 255, 255, 0.12);
                backdrop-filter: blur(8px);
                box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
            }

            .logo {
                width: 100px;
                margin-bottom: 30px;
                transition: transform 0.3s ease;
            }

            .logo:hover {
                transform: scale(1.05);
            }

            h1 {
                color: #fff;
                font-size: 32px;
                margin-bottom: 10px;
                font-weight: 600;
                letter-spacing: 1px;
            }

            h3 {
                color: rgba(255, 255, 255, 0.7);
                font-size: 16px;
                margin-bottom: 40px;
                font-weight: 400;
            }

            .input-group {
                position: relative;
                margin-bottom: 25px;
            }

            .input-group input {
                width: 100%;
                padding: 15px 45px;
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(255, 255, 255, 0.1);
                color: #fff;
                font-size: 15px;
                transition: all 0.3s ease;
            }

            .input-group input::placeholder {
                color: rgba(255, 255, 255, 0.5);
            }

            .input-group input:focus {
                background: rgba(255, 255, 255, 0.1);
                outline: none;
                border-color: rgba(255, 255, 255, 0.3);
            }

            .input-icon {
                position: absolute;
                left: 15px;
                top: 50%;
                transform: translateY(-50%);
                color: rgba(255, 255, 255, 0.5);
                font-size: 18px;
            }

            .login-btn {
                width: 100%;
                padding: 15px;
                background: #fff;
                color: #000;
                border: none;
                font-size: 16px;
                font-weight: 500;
                cursor: pointer;
                transition: all 0.3s ease;
                margin-bottom: 20px;
                text-transform: uppercase;
                letter-spacing: 1px;
            }

            .login-btn:hover {
                background: rgba(255, 255, 255, 0.9);
                transform: translateY(-2px);
            }

            .links {
                margin-top: 30px;
            }

            .links a {
                color: rgba(255, 255, 255, 0.7);
                text-decoration: none;
                font-size: 14px;
                transition: all 0.3s ease;
            }

            .links a:hover {
                color: #fff;
            }

            .errormsg {
                color: #ff6b6b;
                font-size: 14px;
                margin: 10px 0;
            }

            .video-container {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 1;
            }

            .video-container::after {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.3);
                z-index: 1;
            }

            .video-container video {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                object-fit: cover;
                z-index: 0;
            }

            @media (max-width: 900px) {
                .main_container {
                    flex-direction: column;
                }
                .login_container, .video-container {
                    width: 100vw;
                    height: 50vh;
                    min-height: 0;
                }
            }
            @media (max-width: 600px) {
                .main_container {
                    flex-direction: column;
                }
                .video-container {
                    display: none;
                }
                .login_container {
                    padding: 0 15px;
                    max-width: 400px;
                }
                .card {
                    padding: 30px 20px;
                }
            }
        </style>
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