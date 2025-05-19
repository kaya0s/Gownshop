<?php 
    session_start();
    include('../includes/connection_db.php');

    if(isset($_POST['submit-feedback'])) {
        $comment = $_POST['comment'];
    
        if(empty($_SESSION['user_id'])){
             $_SESSION['errormsg']  = "PLEASE LOG IN FIRST";
        header('location: homepage.php');   
        }


     $query = 'INSERT INTO reviews (user_id,comment) values(?,?)';
     $stmt = $conn->prepare($query);
     $stmt->bind_param('is',$_SESSION['user_id'],$comment);
     
     if($stmt->execute()){
        $_SESSION['successmsg']  = "YOUR FEEDBACK HAS BEEN SUBMITTED";
        header('location: homepage.php');
        exit();
     }
    }
?>