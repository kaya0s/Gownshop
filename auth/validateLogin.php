<?php
require_once('../vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
session_start();

// reCAPTCHA validation before any login logic
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

    // Debug: log the response from Google
    file_put_contents(__DIR__ . '/../recaptcha_debug.txt', $result);

    if (!$result_json->success) {
        $_SESSION['loginmsg'] = "reCAPTCHA verification failed. Please try again.";
        header("Location: ../index.php");
        exit();
    }
}

    class LoginSignupPage{
        // login validation
        public function login(){
            session_start();
           
            if (empty(trim($_POST['username'])) && empty(trim($_POST['password']))) {
                usleep(250000); // 250000 microseconds = 0.5 seconds   
                $_SESSION['loginmsg'] = "please enter username and password";
                header('Location:../index.php');
                exit;
            } elseif (empty($_POST['username'])) {
                usleep(250000); // 250000 microseconds = 0.5 seconds
                $_SESSION['loginmsg'] = "Please enter username";
                header('Location:../index.php');
                exit;
            } elseif (empty($_POST['password'])) {
                usleep(250000); // 250000 microseconds = 0.5 seconds
                $_SESSION['loginmsg'] = "Please enter password";
                header('Location:../index.php');
                exit;
            } else {
                require_once('../includes/connection_db.php');
                    
                $stmt = $conn->prepare("SELECT password FROM users WHERE username = ? OR email = ?");
                $stmt->bind_param("ss", $_POST['username'],$_POST['username']);
                $stmt->execute();
                $stmt->store_result();

                if ($stmt->num_rows > 0) {
                // Prepare your statement to get both password and usertype
                $sql = "SELECT firstname,lastname,id,password,user_type,suki_points,address,email FROM users WHERE username = ? OR email = ?";
                $stmt = mysqli_prepare($conn,$sql);
                $stmt->bind_param("ss", $_POST['username'],$_POST['username']);
                $stmt->execute();

                //if theres an error
                if ($stmt->error) {
                    die("Error: " . $stmt->error);
                }

                $stmt->store_result();
                
                // Bind both password and usertype from the result
                $stmt->bind_result($firstname,$lastname,$id,$db_password, $usertype,$suki_points,$address,$email);
                $stmt->fetch();

                    // Verify the password
                    if (password_verify($_POST['password'], $db_password)) {
                        session_start();

                        // getting user information
                        $fullname = $firstname . ' ' . $lastname;
                        $_SESSION['firstname'] = $firstname;
                        $_SESSION['fullname'] = $fullname;  
                        $_SESSION['address']  = $address;
                        $_SESSION['suki_points'] = $suki_points;
                        $_SESSION['user_id'] = $id;
                        $_SESSION['usertype'] = $usertype;
                        $_SESSION['email']=$email;
                        
                        usleep(550000); // Optional delay


                        // Redirect based on usertype
                        if ($usertype === 'admin') {
                            usleep(550000); // Optional delay
                            $_SESSION['successmsg'] = "You have successfully logged in";
                            header('Location: ../admin/dashboard.php');
                           
                            exit;
                        } else{
                            usleep(550000); // Optional delay
                            $_SESSION['successmsg'] = "You have successfully logged in";
                            header('Location: ../customer/homepage.php');
                          
                            exit;
                        }
                    } else {
                        session_start();
                        usleep(250000);
                        $_SESSION['loginmsg'] = "Invalid password";
                        header('Location: ../index.php');
                        exit;
                    }
                } else {
                    session_start();
                    $_SESSION['loginmsg'] = "User not found";
                    header('Location: ../index.php');
                    exit;
                }
                
            }  
                
        }

        // for sign up method
        public function signup() {

            session_start();

            $firstname =trim($_POST['firstname']);
            $lastname = $_POST['lastname'];
            $username =$_POST['username'];
            $address = $_POST['address'];
            
            if (empty($firstname)&&empty($lastname)&&empty($lastname)&&empty($username)&&empty($_POST['email'])&&empty($_POST['address'])&&empty($_POST['phone_number'])&&empty($_POST['password']) ) {
                usleep(250000); // 250000 microseconds = 0.5 seconds
                $_SESSION['signupmsg'] = "Please enter your credentials";
                header('Location:register.php');
                exit;
            }
            elseif (empty($firstname)) {
                usleep(250000); // 250000 microseconds = 0.5 seconds
                $_SESSION['signupmsg'] = "Please enter firstname";
                header('Location:register.php');
                exit;
                
            }
            elseif (empty($address)) {
                usleep(250000); // 250000 microseconds = 0.5 seconds
                $_SESSION['signupmsg'] = "Please enter address";
                header('Location:register.php');
                exit;
                
            }
            elseif (empty($lastname)) {
                usleep(250000); // 250000 microseconds = 0.5 seconds
                $_SESSION['signupmsg'] = "Please enter lastname";
                header('Location: register.php');
                exit;
            } elseif (empty($username)) {
                usleep(250000); // 250000 microseconds = 0.5 seconds
                $_SESSION['signupmsg'] = "Please enter username";
                header('Location: register.php');
                exit;
            }  elseif (empty($_POST['email'])) {
                usleep(250000); // 250000 microseconds = 0.5 seconds
                $_SESSION['signupmsg'] = "Please enter email";
                header('Location: register.php');
                exit;
            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                usleep(250000); 
                $_SESSION['signupmsg'] = "Invalid email format";
                header('Location: register.php');
                exit;
            } elseif (empty($_POST['phone_number'])) {
                usleep(250000); // 250000 microseconds = 0.5 seconds
                $_SESSION['signupmsg'] = "Please enter contact Number";
                header('Location: register.php');
                exit;
            }
            elseif (empty($_POST['password'])) {
                usleep(250000); // 250000 microseconds = 0.5 seconds
                $_SESSION['signupmsg'] = 'Please enter password';
                header('Location: register.php');
                exit;
            }
            require_once('../includes/connection_db.php');
            // Check if username already exists 
            $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
            $stmt->bind_param("ss", $_POST['username'],$_POST['email']);
            $stmt->execute();
            


            $stmt->store_result();
            
            if ($stmt->num_rows > 0) {
                usleep(550000); 
                $_SESSION['signupmsg'] = "account already taken";
                header('Location:register.php');
                exit;
            }

            $stmt->close();
        
            $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, username, email, password,contact_number,address) VALUES (?, ?, ?, ?, ?,?,?)");
            $stmt->bind_param("sssssss", $_POST['firstname'], $_POST['lastname'], $_POST['username'], $_POST['email'],$hashed_password,$_POST['phone_number'],$address);
            
            if ($stmt->execute()) {
                usleep(550000);
               
                $_SESSION['successmsg'] ="You have successfully signed up! You can now log in.";
                header('Location:../index.php');
                
                exit;
            } else {
                usleep(550000); 
                $_SESSION['successmsg'] ='Error in signup';
                header('Location:../index.php');
                
                exit;
            }
        
        }
        
    }

    $loginSignup = new LoginSignupPage;
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
        $loginSignup->login();  
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
        $loginSignup->signup();  
    }
?>

