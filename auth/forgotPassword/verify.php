<!DOCTYPE html>
<html>
    <head>
        <title>HJ Gownshop | Verify</title>
        <link rel="stylesheet" href="../../assets/css/style.css">
        <script src="../../assets/js/login.js"></script>
        <link rel="icon" type="image/png" href="../../assets/images/HJ Logo.png">
    </head>
    <body>
        <div class="main_container">
            <div class="login_container">
                <div class="card">
                    <img src="../../assets/images/HJ Logo.png" alt="This is a logo">
                    <?php
                                session_start();
                                require_once('../../config/connection_db.php');
                                // Only generate code if not already set
                                if (!isset($_SESSION['code'])) {
                                    $_SESSION['code'] = str_pad(mt_rand(100000, 999999), 6, '0', STR_PAD_LEFT);
                                }
                            
                                if (isset($_POST['verify']) && $_SERVER['REQUEST_METHOD'] == "POST") {
                                    if (empty($_POST['code'])) {

                                        usleep(250000); // Sleep 0.25 seconds
                                        header("location: verify.php?errormsg=please enter code");
                                        exit;
                                    } elseif ($_POST['code'] == $_SESSION['code']) {
                                        // Clear session code after successful verification
                                        unset($_SESSION['code']);
                                        header("Location: newpassword.php");
                                        exit;
                                    } else {
                                        unset($_SESSION['code']);
                                        header("location: verify.php?errormsg=invalid code");
                                        exit;
                                    }
                                }
                            ?>

                    <form action="verify.php" method="POST">
                        <h1>Welcome to HJ Gown's</h1>
                        <h3>Enter Code</h3>
                        
                        <!-- email input -->
                        <div class="input-group">
                            <img src="../../assets/images/user (1).png" alt="Username icon" class="input-icon">
                            <input type="text" placeholder="Enter Code" name="code">
                        </div>
                            
                            <button class="login-btn" type="submit" value="verify"  name="verify" >VERIFY</button>

                            <h2>
                            <?php
                            
                             ?><script>
                            alert('Verification code : <?php echo $_SESSION['code'] ;?>');
                            console.log('Verification code: <?php echo $_SESSION['code'] ;?>')
                           </script>
                            </h2>

                             <!-- error message if set -->
                            <p class="errormsg"> <?php
                            if(isset($_GET['errormsg'])){
                             echo htmlspecialchars($_GET['errormsg']);
                            }
                            ?>
                            
                             </p>
                
                        <p>Don't have an account? <a href="../../pages/signup.php">Sign up</a></p>
                        <p>or</p>
                        <p><a href=".../index.php">Login?</a></p>
                    </form>
                </div>
            </div>
            <div class="video_container">
                <!-- <h1>This is video container</h1> -->
            </div>
        </div>
    </body>
</html>