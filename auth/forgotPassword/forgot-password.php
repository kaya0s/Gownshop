<?php

session_start();
require '../../vendor/autoload.php'; // PHPMailer
require '../../includes/connection_db.php'; // Make sure this file sets up your $conn = mysqli_connect(...)

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    
    $email = $_POST['email'];
    
    if(empty($email)){
        $_SESSION['error'] = "please enter an email";
        header('Location: forgot-password.php');
        exit();
    }

    // Check if user exists
    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($user = mysqli_fetch_assoc($result)) {
        // Generate reset code
        $reset_code = rand(100000, 999999);

        // Update the reset code
        $update = mysqli_prepare($conn, "UPDATE users SET reset_code = ? WHERE email = ?");
        mysqli_stmt_bind_param($update, "is", $reset_code, $email);
        mysqli_stmt_execute($update);

        $_SESSION['email'] = $email;
        $mail = new PHPMailer(true);

        try {
            
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = $_ENV['EMAIL_ADMIN']; 
            $mail->Password   = $_ENV['EMAIL_PASS'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom($_ENV['EMAIL_ADMIN'], 'HJ Gownshop');
            $mail->addAddress($email, 'User');

            $mail->isHTML(true);
            $mail->Subject = 'Password Verification Code';
            $mail->Body = "
                <div style='padding: 20px;'>
                    <div style='max-width: 600px; margin: auto; padding: 20px;'>
                        <h2>Password Reset Code</h2>
                        <p>Hello, use the following code to reset your password:</p>
                        <div style='text-align: center;'>
                            <p style='font-weight: bold;'>$reset_code</p>
                        </div>
                    </div>
                </div>";
            $mail->AltBody = "Hello user, use the code to reset: $reset_code";

            $mail->send();

            $_SESSION['email_sent'] = true;
            $_SESSION['success'] = "A verification code has been sent to your email.";
            header('Location: send_code.php');
            exit();
        } catch (Exception $e) {
            $_SESSION['error'] = "There was an error sending your email: " . $mail->ErrorInfo;
            header('Location: forgot-password.php');
            exit();
        }
    } else {
        $_SESSION['error'] = "This email address was not found.";
        header('Location: forgot-password.php');
        exit();
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>HJ Gownshop | Forgot Password</title>
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
                    <form action="forgot-password.php" method="POST">
                        <h1>Forgot Password</h1>
                        <h3>Enter your email to reset your password</h3>

                        <div class="input-group">
                            <i class="fas fa-envelope input-icon"></i>
                            <input type="email" placeholder="Enter your email" name="email" required>
                        </div>

                        <button class="login-btn" type="submit" name="login">Send Reset Code</button>

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
                            <p style="margin-top: 10px;">Don't have an account? <a href="../register.php">Sign up</a></p>
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