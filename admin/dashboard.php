<?php
session_start();
require('add-admin.php');
require('../includes/connection_db.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D A S H B O A R D</title>
    <link rel="stylesheet" href="../assets/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/uiverse.css">
    <!-- Bootstrap Bundle includes Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" href="../assets/images/HJ Logo.png">

</head>
<body>
     <?php require_once('../includes/alertmsg.php');?> <!--alert message -->
    <div class="dashboard">
        <div class="sidebar">
            <div class="heads">
                <img style="border-radius: 50%;box-shadow: 0px 4px 8px rgb(0, 0, 0,0.3);" src="../assets/images/HJ Logo.png" alt="logo">
            </div>
            <ul class="menu">
                <!-- ACTIVE BUTTON -->
                <li style=" background-color: rgb(93, 92, 92); border-radius: 5px;">
                    <a href="dashboard.php" class="active">
                        <img src="../assets/images/icons/dashB.png" alt="dashboard">
                        <span>Dashboard</span>
                    </a>
                </li>
                <li >
                    <!-- ADD ADMIN BUTTON  MODAL -->
                    <button type="button" class="btn d-flex align-items-center p-2 rounded" 
                            data-bs-toggle="modal" data-bs-target="#exampleModal"
                             style="width: 100%;" >
                        <img src="../assets/images/icons/admin.png" alt="dashboard" style="height: 30px;">
                        <span style="margin-left: 20px;font-size: larger; ">Add admin</span>
                    </button>

                </li>
                <!-- gowns BUTTON IN SIDEBAR -->
                <li>
                    <a href="gowns.php">
                        <img src="../assets/images/icons/product.png" alt="dashboard">
                        <span>Gowns</span>
                    </a>
                </li>

                    <!-- REVIEWS  -->
                <li>
                    <a href="reviews.php">
                        <img src="../assets/images/icons/reviews_icon.png" alt="review icon">
                        <span>Reviews</span>
                    </a>
                </li>


                    <!-- LOGOUT BUTTON IN SIDEBAR -->
                <li>
                    <a href="../auth/logout.php">
                        <img src="../assets/images/icons/logout.png" alt="dashboard">
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
            <div class="footer" >
                        HJ gownshop ©copyright 2025 
            </div>
        </div>


        <div class="main-content">
            <div class="topbar">
                <div class="dashGreet">
                    <button style="color: whitesmoke;" id="toggleSidebar" class="toggle-btn">☰</button>
                    <div class="greetAdmin" style="margin-left: 10px;" >
                        <h2>Welcome, Admin!</h2>  
                        <h6 id="dateTimeDisplay"></h6>   
                        </div>


                        
                </div>
                <div class="user-profile" style="margin-left: 50px;">
                    <span><?php if(isset($_SESSION['fullname'])){
                        echo $_SESSION['fullname'];     
                    }else{
                        echo "Admin"; 
                    }
                    ?> </span>
                    </span>
                    <img style="background-color: white; width: 35px; height: 35px;" src="../assets/images/icons/customer-icon.png" alt="user">  

                </div>
            </div>
            
            <!-- content -->
            <div class="content">


                <div class="row"    >

                    <!-- Button trigger modal -->
               
                    <!-- STATISTICS -->

                    <?php 
                    $query = mysqli_query($conn, "SELECT COUNT(*) AS total_transaction FROM transactions;");
                    $row = mysqli_fetch_assoc($query);
                    $totalTransaction = $row['total_transaction'];

                    ?>
                    <div class="wew p-3" style="width: 25%; border-radius: 10px; background-color: white; box-shadow: 0 10px 25px rgba(21, 87, 81, 0.25);margin: 10px; margin-top:0px">
                        <div class="d-flex align-items-center">
                            <!-- Left Column: Text and Number -->
                            <div class="flex-grow-1">
                            <p class="mb-1" style="font-size: 18px; color: #555;">Total Transactions</p>
                            <h1 style="font-size: 64px; font-weight: bold; color: #041623;"><?php echo $totalTransaction?></h1>
                            </div>
                            <!-- Right Column: Image -->
                            <img src="../assets/images/icons/sales-icon.png" alt="Gown icon">
                        </div>
                        </div>
                        <?php 
                    $query = mysqli_query($conn, "SELECT COUNT(status) AS total_returned  FROM transactions where status ='returned';");
                    $row = mysqli_fetch_assoc($query);
                    $Returned = $row['total_returned'];

                    ?>
                        <div class="wew p-3" style="width: 25%; border-radius: 10px; background-color: white; box-shadow: 0 10px 25px rgba(21, 87, 81, 0.25);margin: 10px;margin-top:0px ">
                            <div class="d-flex align-items-center">
                                <!-- Left Column: Text and Number -->
                                <div class="flex-grow-1">
                                <p class="mb-1" style="font-size: 18px; color: #555;">Completed Transactions</p>
                                <h1 style="font-size: 64px; font-weight: bold; color:#041623;"><?php echo $Returned; ?></h1>
                                </div>
                                <!-- Right Column: Image -->
                                <img src="../assets/images/icons/customer-icon.png" alt="Gown icon" >
                        </div>
                        </div>

                        <?php 
                    $query = mysqli_query($conn, "SELECT COUNT(status) AS total_unreturned  FROM transactions where status ='unreturned';");
                    $row = mysqli_fetch_assoc($query);
                    $Unreturned = $row['total_unreturned'];

                    ?>
                        <div class="wew p-3" style="width: 25%; border-radius: 10px; background-color: white; box-shadow: 0 10px 25px rgba(21, 87, 81, 0.25);margin: 10px;margin-top:0px ">
                            <div class="d-flex align-items-center">
                                <!-- Left Column: Text and Number -->
                                <div class="flex-grow-1">
                                <p class="mb-1" style="font-size: 18px; color:rgb(146, 42, 42);">Unreturned Gowns</p>
                                <h1 style="font-size: 64px; font-weight: bold; color:rgb(146, 42, 42);"><?php echo $Unreturned; ?></h1>
                                </div>
                                <!-- Right Column: Image -->
                                <img src="../assets/images/icons/unreturned-icon.png" alt="Gown icon" style="width: 60px;">
                        </div>
                        </div>

                </div>

                <!-- TABLE -->
                <?php include('read-transaction.php'); ?>
                            
         
         
                
        </div>
    </div>
    </div>
</body>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<!-- date time -->
<script src="../assets/js/datetime.js" ></script>  
<!-- SIDEBAR HIDE -->
<script src="../assets/js/sidebar.js"></script>
</html>