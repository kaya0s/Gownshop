<?php
    session_start();
    require('../connection_db.php');
    if(isset($_GET['orderID']) ){


        $stmt = $conn->prepare("INSERT INTO TRANSACTIONS(user_id,gown_id,total_price) VALUES(?,?,?)");
        $stmt->bind_param("iid",$_GET['user_id'], $_GET['gown_id'],$_GET['totalprice']);

        if($stmt->execute()){

            $_SESSION['successmsg'] ="PAYMENT SUCCESSFULLY YOUR BOOKING WILL BE PENDING";
            header("location: ../../customer/dashboard.php");
            exit();
        }else{
            $_SESSION['errormsg'] ="Error Payment";
            header("location: ../../customer/payment.php");
            exit();
        }






    }




?>

