<?php
    session_start();
    require('../connection_db.php');
    if(isset($_SESSION['gown_id']) ){

        $stmt = $conn->prepare("INSERT INTO TRANSACTIONS(user_id,gown_id,total_price) VALUES(?,?,?)");
        $stmt->bind_param("iii",$_SESSION['user_id'], $_SESSION['gown_id'],$_SESSION['price']);

        if($stmt->execute()){
           
            
            mysqli_query($conn, "UPDATE users SET suki_points = suki_points+50 WHERE id = ".$_SESSION['user_id']);
            unset($_SESSION['gown_id'],$_SESSION['price']);
            $_SESSION['successmsg'] ="PAYMENT SUCCESSFULLY YOUR BOOKING WILL BE PENDING. \n ADDED 50 SUKI POINTS ADDED";
            header("location: ../../customer/homepage.php");
            $stmt->close();
            exit();
        }else{
            $_SESSION['errormsg'] ="Error Payment";
            
            header("location: ../../customer/payment.php");
            exit();
        }

    }else{
        $_SESSION['errormsg'] = "gown id not set";
        header("location:  ../../customer/homepage.php");
    }




?>

