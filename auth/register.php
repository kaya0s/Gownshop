<?php 
session_start();
require_once('../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/..');
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
?>
<!DOCTYPE html>
<html>
    <head>
        <title>HJ Gownshop | Create an account</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="../assets/images/HJ Logo.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
                max-width: 800px;
                padding: 0 20px;
            }

            .card {
                width: 100%;
                text-align: center;
                background:  #041623;
                padding: 40px;
                border: 1px solid rgba(255, 255, 255, 0.12);
                backdrop-filter: blur(8px);
                box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
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
                margin-bottom: 30px;
                font-weight: 400;
            }

            .input-row {
                display: flex;
                gap: 20px;
                margin-bottom: 25px;
            }

            .input-group {
                position: relative;
                flex: 1;
            }

            .input-group input {
                width: 100%;
                padding: 12px 45px;
                background: rgba(255, 255, 255, 0.09);
                border: 1.5px solid rgba(255, 255, 255, 0.13);
                color: #fff;
                font-size: 14px;
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

            .password-icon {
                position: absolute;
                right: 15px;
                top: 50%;
                transform: translateY(-50%);
                color: rgba(255, 255, 255, 0.5);
                font-size: 18px;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .password-icon:hover {
                color: rgba(255, 255, 255, 0.8);
            }

            .login-btn {
                width: 100%;
                padding: 15px;
                background: #fff;
                color: #000;
                border: none;
                font-size: 16px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                margin-top: 22px;
                margin-bottom: 22px;
                text-transform: uppercase;
                letter-spacing: 1px;
                box-shadow: 0 2px 8px 0 rgba(0,0,0,0.08);
            }

            .login-btn:hover {
                background: rgba(255, 255, 255, 0.9);
                transform: translateY(-2px);
            }

            .google-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 100%;
                padding: 12px;
                background: rgba(255, 255, 255, 0.09);
                border: 1.5px solid rgba(255, 255, 255, 0.13);
                font-size: 15px;
                color: #fff;
                text-decoration: none;
                transition: all 0.3s ease;
                margin-bottom: 22px;
            }

            .google-btn:hover {
                background: rgba(255, 255, 255, 0.1);
                border-color: rgba(255, 255, 255, 0.2);
            }

            .google-icon {
                margin-right: 10px;
            }

            .links {
                margin-top: 24px;
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
                font-size: 15px;
                margin: 12px 0 0 0;
                min-height: 20px;
                text-align: center;
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
                .login_container {
                    max-width: 600px;
                }
                .input-row {
                    flex-direction: column;
                    gap: 0;
                }
            }

            @media (max-width: 600px) {
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
                    <form action="validateLogin.php" method="POST">
                        <h1>Create an Account</h1>
                        <h3>Fill in the details below</h3>

                        <div class="input-row">
                            <div class="input-group">
                                <i class="fas fa-user input-icon"></i>
                                <input type="text" placeholder="Firstname" name="firstname" required>
                            </div>

                            <div class="input-group">
                                <i class="fas fa-user input-icon"></i>
                                <input type="text" placeholder="Lastname" name="lastname" required>
                            </div>
                        </div>

                        <div class="input-row">
                            <div class="input-group">
                                <i class="fas fa-user input-icon"></i>
                                <input type="text" placeholder="Username" name="username" required>
                            </div>

                            <div class="input-group">
                                <i class="fas fa-envelope input-icon"></i>
                                <input type="email" placeholder="Email" name="email" required>
                            </div>
                        </div>

                        <div class="input-row">
                            <div class="input-group">
                                <i class="fas fa-home input-icon"></i>
                                <input type="text" placeholder="Address" name="address" required>
                            </div>

                            <div class="input-group">
                                <i class="fas fa-phone input-icon"></i>
                                <input type="text" placeholder="Phone Number" name="phone_number" required>
                            </div>
                        </div>

                        <div class="input-group">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" placeholder="Password" name="password" id="passwordInput" minlength="8" required>
                            <i class="fas fa-eye password-icon" id="showPassword"></i>
                            <i class="fas fa-eye-slash password-icon" id="hidePassword" style="display: none;"></i>
                        </div>

                        <button class="login-btn" type="submit" name="signup">Sign Up</button>

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
                            if(isset($_SESSION['signupmsg'])) {
                                echo htmlspecialchars($_SESSION['signupmsg']);
                                unset($_SESSION['signupmsg']);
                            }
                            ?>
                        </p>

                        <div class="links">
                            <p style="margin-top: 10px; color: rgba(255, 255, 255, 0.7);">Already have an account? <a href="../index.php">Sign in</a></p>
                        </div>
                    </form>
                </div>
            </div>

            <div class="video-container">
                <video autoplay muted loop>
                    <source src="../assets/videos/gown.mp4" type="video/mp4">
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
        </script>
    </body>
</html>