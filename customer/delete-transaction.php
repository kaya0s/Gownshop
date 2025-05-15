<?php

    session_start();
    include('../includes/connection_db.php');

    //remove transaction
     if($_SERVER['REQUEST_METHOD']=="POST" && isset($_GET['id'])){
        

        //test
        mysqli_query($conn,"DELETE FROM TRANSACTIONS WHERE ID = ".$_GET['id']."");
    
        $_SESSION['successmsg'] = "SUCCESSFULLY CANCELLED THE BOOKING ";
        header("location:my-transaction.php");

        $stmt->close();
        exit();
        

        
        
     }else{
        $_SESSION['successmsg'] = "TRANSACTION ID IS NOT SET";
        header("location:my-transaction.php");
        exit();
     }
        
        




?>