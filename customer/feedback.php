<?php 
    session_start();
    include('../includes/connection_db.php');

    if(isset($_POST['submit-feedback'])) {
        $comment = $_POST['comment'];

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