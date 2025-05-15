<?php
session_start();
include('../includes/connection_db.php');

$result = mysqli_query($conn,"SELECT * FROM gowns where id  =".$_SESSION['gown_id']);
$gown = mysqli_fetch_assoc($result);

if($_SESSION['suki_points'] >= 1000){
    
    // DEDUCTING SUKI POINTS
    mysqli_query($conn, "UPDATE users SET suki_points = " .$_SESSION['suki_points']."-1000 WHERE id = " . $_SESSION['user_id']);

    mysqli_query($conn, "INSERT INTO transactions (user_id,gown_id,payment_method,status,total_price) VALUES (".$_SESSION['user_id'].",".$_SESSION['gown_id'].",'suki_points','pending',".$_SESSION['price'].");");
    
    usleep(1000000);
    $_SESSION['successmsg'] = "YOU HAVE SUCCESSFULLY USED YOUR POINTS TO RENT A GOWN! 1000 POINTS DEDUCTED";
    header('location: homepage.php');
    exit();
}else{
    $_SESSION['errormsg'] = "INSUFFICIENT POINTS";
    
    header('location: payment.php');
    exit();
}

?>