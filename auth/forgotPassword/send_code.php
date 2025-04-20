<?php
    session_start();

   
    if(isset($_POST['sendcode'])&&$_SERVER['REQUEST_METHOD'] === "POST"){

         require_once('../../includes/connection_db.php');
        
        $code = $_POST['code'];

        $query = "SELECT * FROM USERS WHERE email = '{$_SESSION['email']}'";
        $result = mysqli_query($conn,$query);

        if(mysqli_num_rows($result)>0){
            $row = mysqli_fetch_assoc($result);
            if($code == $row['reset_code']){
                header("location: new-password.php");
            }else{
                $_SESSION['error'] = "you entered a wrong code";
            }

        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
            <title>HJ Gownshop | Create an account</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="icon" type="image/png" href="../assets/images/HJ Logo.png">
            <link rel="stylesheet" href="../../assets/css/login.css">
            <script src="../assets/js/login.js"></script>
    </head>
    <body>
       <div class="main_container">

        <div class="login_container">
            <div class="card">
                <img src="../../assets/images/HJ Logo.png "  alt="This is a logo">

                <form action="send_code.php" method="POST">
                <h1 style="color: black; margin-bottom: 10px;">Welcome to HJ Gowns</h1>
                <h3 style="color: black; text-align: center; ">Enter Verification Code</h3>
                    
                    <div class="input-group" >
                         <img src="../assets/images/user (1).png" alt="Username icon" class="input-icon">
                        <input type="text" placeholder="code" name="code" >
                    </div> 
                        
                        <button class="login-btn" type="submit" value="signup"  name="sendcode" >Send Code</button>
                        
                            <p class="errormsg"> <?php
                            if(isset($_SESSION['error'])){
                             echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); }?>
                             </p>
                             
                        
                </form>
                <p>Don't have an account? <a href="pages/signup.php">Sign up</a></p>
            </div>
        </div>

        <div class="video_container">
            <!-- <h1>this is video video conrtainer</h1> -->
        </div>

       </div>

    </body>
</html>