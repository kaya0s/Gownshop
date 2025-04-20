<?php
    include('../includes/connection_db.php');

    $result = mysqli_query($conn, "SELECT * FROM gowns");
    $totalGowns = mysqli_num_rows($result);
    $availableGowns = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM gowns WHERE available = 1"));
    $unavailableGowns = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM gowns WHERE available IS NULL"));  
?>