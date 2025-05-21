<?PHP
session_start();
require_once('vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Initialize Google Client
$client = new Google_Client();
$client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
$client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
$client->setRedirectUri($_ENV['GOOGLE_REDIRECT']);
$client->addScope('email');
$client->addScope('profile');
$client->setPrompt('select_account');
$authUrl = $client->createAuthUrl();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    // Check if reCAPTCHA response exists
    if (empty($_POST['g-recaptcha-response'])) {
        $_SESSION['loginmsg'] = "Please complete the reCAPTCHA.";
        header("Location: ../index.php");
        exit();
    }

    // Verify reCAPTCHA with Google
    $recaptcha_secret = $_ENV['RECAPTCHA_SECRET_KEY'];
    $recaptcha_response = $_POST['g-recaptcha-response'];
    $verify_url = "https://www.google.com/recaptcha/api/siteverify";
    $data = [
        'secret' => $recaptcha_secret,
        'response' => $recaptcha_response,
        'remoteip' => $_SERVER['REMOTE_ADDR']
    ];
    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        ]
    ];
    $context = stream_context_create($options);
    $result = file_get_contents($verify_url, false, $context);
    $result_json = json_decode($result);

    if (!$result_json->success) {
        $_SESSION['loginmsg'] = "reCAPTCHA verification failed. Please try again.";
        header("Location: ../index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>HJ Gownshop</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="assets/images/HJ Logo.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <link rel="stylesheet" href="assets/css/index.css">
        
    </head>
    <body>
        <?php include('includes/alertmsg.php'); ?>
        <div class="main_container">
            <div class="login_container">
                <div class="card">
                    <img src="assets/images/HJ Logo.png" class="logo" alt="HJ Gownshop Logo">

                    <form action="auth/validateLogin.php" method="POST" id="loginForm">
                        <h1>Welcome Back</h1>
                        <h3>Sign in to continue</h3>

                        <div class="input-group">
                            <i class="fas fa-user input-icon"></i>
                            <input type="text" placeholder="Username or email" name="username" required>
                        </div>

                        <div class="input-group">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" placeholder="Password" name="password" id="passwordInput" minlength="8" required>
                            <i class="fas fa-eye password-icon" id="showPassword"></i>
                            <i class="fas fa-eye-slash password-icon" id="hidePassword" style="display: none;"></i>
                        </div>

                        <div class="recaptcha-group" style="display: flex; align-items: center; justify-content: center; margin-bottom: 25px;">
                            <div class="g-recaptcha" data-sitekey="<?php echo $_ENV['RECAPTCHA_SITE_KEY']; ?>" data-callback="enableLoginButton"></div>
                        </div>

                        <button class="login-btn" type="submit" name="login" id="loginBtn" disabled>Sign In</button>

                        <a href="<?php echo $authUrl; ?>" class="google-btn">
                            <svg class="google-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 48 48">
                                <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
                                <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
                                <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/>
                                <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
                            </svg>
                            Continue with Google
                        </a>

                        <p class="errormsg">
                            <?php
                            if(isset($_SESSION['loginmsg'])) {
                                echo htmlspecialchars($_SESSION['loginmsg']);
                                unset($_SESSION['loginmsg']);
                            }
                            ?>
                        </p>

                        <div class="links">
                            <a href="auth/forgotpassword/forgot-password.php">Forgot Password?</a>
                            <p style="margin-top: 10px; color: rgba(255, 255, 255, 0.7);">Don't have an account? <a href="auth/register.php">Sign up</a></p>
                        </div>
                    </form>
                </div>
            </div>

            <div class="video-container">
                <video autoplay muted loop>
                    <source src="assets/videos/gown.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>

        <script>
            // Password visibility toggle
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

            function enableLoginButton() {
                document.getElementById('loginBtn').disabled = false;
            }
        </script>
    </body>
</html>