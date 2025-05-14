    <?php
    require_once('../../vendor/autoload.php');
    session_start();

    // Load .env
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../../');
    $dotenv->load();

    // Create Google Client
    $client = new Google_Client();
    $client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
    $client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
    $client->setRedirectUri($_ENV['GOOGLE_REDIRECT']);
    $client->addScope('email');
    $client->addScope('profile');

    if (isset($_GET['code'])) {
        try {
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

            if (!isset($token['error'])) {
                $client->setAccessToken($token['access_token']);

                // Get user info
                $oauth2 = new Google\Service\Oauth2($client);
                $userInfo = $oauth2->userinfo->get();

                // Store user data in session
                $_SESSION['user_type'] = 'google';
                $_SESSION['user_name'] = $userInfo->name;
                $_SESSION['user_email'] = $userInfo->email;
                $_SESSION['user_image'] = $userInfo->picture;
                $_SESSION['successmsg'] = "Logged in with Google!";
                

                header('Location: ../../admin/dashboard.php');
                exit();
            } else {
                throw new Exception("Google OAuth error: " . $token['error']);
            }

            
        } catch (Exception $e) {
            $_SESSION['errormsg'] = "Login failed: " . $e->getMessage();
            header('Location: ../../index.php');
            exit();
        }
    } else {
        $_SESSION['errormsg'] = "Invalid login request.";
        header('Location: ../../index.php');
        exit();
    }
    ?>