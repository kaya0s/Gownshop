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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
 <link rel="stylesheet" href="../../assets/css/login.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
 <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
 <link href="https://fonts.googleapis.com/css2?family=Noto Sans:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="main_container">
        <div class="login_container">
            <div class="card">
                <img class=".logo" src="../../assets/images/HJ Logo.png" alt="This is a logo">

                <form action="forgot-password.php" method="POST">
                    <h1>Welcome to HJ Gowns</h1>
                    <h3 style="text-align: center;" >Forgot Password</h3>

                    <!-- email input -->
                    <div class="input-group">
                        <img src="assets/images/user (1).png" alt="Username icon" class="input-icon">
                        <input type="text" placeholder="Enter your Email" name="email">
                    </div>
                        <button class="login-btn" type="submit" value="login"  name="login" >Continue</button>
                            <div style="font-size:smaller" class="errormsg" >
                            <?php if(isset($_SESSION['error'])){ ?> 
                        
                        <?php echo $_SESSION['error']; unset($_SESSION['error']); }?>
                            </div>
                        
                    <p>Don't have an account? <a href="../register.php">Sign up</a></p>
                    <p>or</p>
                <p><a href="../../index.php">Login</a></p>
                </form>
                </
                </div>
                
            </div>
        </div>
                <div class="video_container">
                    <!-- <h1>This is video container</h1> -->
            </div>
    </div>
</body>

</html>