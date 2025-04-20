<?php

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
                $sql = "SELECT firstname,lastname,id,password, user_type FROM users WHERE username = ? OR email = ?";
                $stmt = mysqli_prepare($conn,$sql);
                $stmt->bind_param("ss", $_POST['username'],$_POST['username']);
                $stmt->execute();

                //if theres an error
                if ($stmt->error) {
                    die("Error: " . $stmt->error);
                }

                $stmt->store_result();
                
                // Bind both password and usertype from the result
                $stmt->bind_result($firstname,$lastname,$id,$db_password, $usertype);
                $stmt->fetch();

                    // Verify the password
                    if (password_verify($_POST['password'], $db_password)) {
                        session_start();

                        // getting full name
                        $fullname = $firstname . ' ' . $lastname;
                        $_SESSION['fullname'] = $fullname;

                        $_SESSION['successmsg'] = "Login successfully!";
                        $_SESSION['id'] = $id;
                        $_SESSION['username'] = $_POST['username'];
                        $_SESSION['usertype'] = $usertype;


                        usleep(550000); // Optional delay


                        // Redirect based on usertype
                        if ($usertype === 'admin') {
                            header('Location: ../admin/dashboard.php');
                        } else{
                            header('Location: ../customer/customer.php');
                        }
                        exit;
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
                
                $stmt->close();
                $conn->close();
            }  
                
        }

        // for sign up method
        public function signup() {
            session_start();

            $firstname =trim($_POST['firstname']);
            $lastname = $_POST['lastname'];
            $username =$_POST['username'];
            
            if (empty($firstname)&&empty($lastname)&&empty($lastname)&&empty($username)&&empty($_POST['email'])&&empty($_POST['address'])&&empty($_POST['phone'])&&empty($_POST['password']) ) {
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
            } elseif (empty($lastname)) {
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
            } elseif (empty($_POST['phone'])) {
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
            $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, username, email, password,contact_number) VALUES (?, ?, ?, ?, ?,?)");
            $stmt->bind_param("ssssss", $_POST['firstname'], $_POST['lastname'], $_POST['username'], $_POST['email'],$hashed_password,$_POST['phone']);
            
            if ($stmt->execute()) {
                usleep(550000);
               
                $_SESSION['successmsg'] ="You have successfully signed up! You can now log in.";
                header('Location:../index.php');
                
                exit;
            } else {
                usleep(550000); 
                $_SESSION['signupmsg'] ='Error in signup';
                header('Location:../pages/none.php');
                
                exit;
            }
        
            $stmt->close(); 
            $conn->close();
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

