    <?php
    include('../../includes/connection_db.php');
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

                $stmt= $conn->prepare("SELECT * FROM USERS WHERE EMAIL = ?");
                $stmt->bind_param("s",$userInfo->email);
                $stmt->execute();
                $result =  $stmt->get_result();
                $user = $result->fetch_assoc();

                // STORING SESSIONS 
                $_SESSION['fullname'] = $user['firstname']." ".$user['lastname'];  
                $_SESSION['address']  = $user['address'];
                $_SESSION['suki_points'] = $user['suki_points'];
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['usertype'] = $user['user_type'];
                
                if($user['user_type'] === "admin"){
                $_SESSION['successmsg'] = "SUCCESSFULLY LOGGED IN WITH GOOGLE";
                header('Location: ../../admin/dashboard.php?');
                exit();

                }elseif($user['user_type'] === "customer"){
                    $_SESSION['successmsg'] = "SUCCESSFULLY LOGGED IN WITH GOOGLE";
                    header('Location: ../../customer/homepage.php');
                    exit();
                }else{
                    $_SESSION['errormsg'] = "THIS GOOGLE ACCOUNT NOT REGISTERED IN OUR SYSTEM";

                    header("location:../../index.php");
                    exit();
                }
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