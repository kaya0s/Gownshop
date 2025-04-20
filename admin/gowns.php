<?php
session_start();
require('../includes/connection_db.php');
require('add-admin.php');
require_once('add-gown.php');
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
    <link rel="icon" type="image/png" href="../images/logo.png">
    <link rel="stylesheet" href="../assets/css/add-gownButton.css">
    <!-- Bootstrap Bundle includes Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
</head>

<body>
  <?php require_once('../includes/alertmsg.php');?> <!--alert message -->
  
    <div class="dashboard">
        <!-- SIDEBAR -->
        <div class="sidebar">
        <div class="heads">
            <img style="border-radius: 50%;box-shadow: 0px 4px 8px rgb(0, 0, 0,0.3);" src="../assets/images/HJ Logo.png" alt="logo">
        </div>
        <ul class="menu">
            <li >
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

            <li>
                <a  style=" background-color: rgb(24, 24, 24); border-radius: 5px;"href="gowns.php">
                    <img src="../assets/images/icons/product.png" alt="dashboard">
                    <span>Gowns</span>
                </a>
            </li>
            
            <li>
                <a href="../index.html">
                    <img src="../assets/images/icons/logout.png" alt="dashboard">
                    <span>Logout</span>
                </a>
            </li>
        </ul>
        <div class="footer" >
                        HJ gownshop ©copyright 2025 
            </div>
        </div>

        <!-- main-content -->
        <div class="main-content">


            <!-- Topbar -->
            <div class="topbar">
                <div class="dashGreet">
                    <button id="toggleSidebar" class="toggle-btn">☰</button>
                    <div class="greetAdmin" style="margin-left: 10px;" >
                        <h2>Welcome, Admin!</h2>  
                        <h6 id="dateTimeDisplay"></h6>   
                        </div>
                    

                        
                </div>
                <div class="user-profile" style="margin-left: 50px;">
                    <span>Erwin Lanzaderas</span>
                    <img src="icon.png" alt="user">

                </div>
            </div>
                
             <!-- content -->
            <div class="content" >
                
                    <div class="row">
                       <?php include('gown-statistics.php') ?> 
                        <!-- total gownss -->
                            <div class="wew p-3" style="width: 25%; border-radius: 10px; background-color: white; box-shadow: 0 10px 25px rgba(21, 87, 81, 0.25);margin: 10px; margin-top: 0px;">
                                <div class="d-flex align-items-center">
                                    <!-- Left Column: Text and Number -->
                                    <div class="flex-grow-1">
                                    <p class="mb-1" style="font-size: 18px; color: #555;">Total Gowns</p>
                                    <h1 style="font-size: 64px; font-weight: bold; color: #186864;"><?php echo $totalGowns  ?></h1>
                                    </div>
                                    <!-- Right Column: Image -->
                                    <img src="icon.png" alt="Gown icon" style="width: 100px;">
                                </div>
                            </div>

                        <div class="wew p-3" style="width: 25%; border-radius: 10px; background-color: white; box-shadow: 0 10px 25px rgba(21, 87, 81, 0.25);margin: 10px;margin-top: 0px; ">
                            <div class="d-flex align-items-center">
                                <!-- Left Column: Text and Number -->
                                <div class="flex-grow-1">
                                <p class="mb-1" style="font-size: 18px; color: #555;">Available Gowns</p>
                                <h1 style="font-size: 64px; font-weight: bold; color: #186864;"><?php echo $availableGowns  ?></h1>
                                </div>
                                <!-- Right Column: Image -->
                                <img src="icon.png" alt="Gown icon" style="width: 100px;">
                            </div>
                        </div>

                        <div class="wew p-3" style="width: 25%; border-radius: 10px; background-color: white; box-shadow: 0 10px 25px rgba(21, 87, 81, 0.25);margin: 10px; margin-top: 0px;">
                            <div class="d-flex align-items-center">
                                <!-- Left Column: Text and Number -->
                                <div class="flex-grow-1">
                                <p class="mb-1" style="font-size: 18px; color: #555;">Unavailable Gowns</p>
                                <h1 style="font-size: 64px; font-weight: bold; color: #186864;"><?php echo $unavailableGowns  ?></h1>
                                </div>
                                <!-- Right Column: Image -->
                                <img src="icon.png" alt="Gown icon" style="width: 100px;">
                            </div>
                        </div>    
                        <button type="button" class="btn btn-outline-primary d-flex flex-column justify-content-center align-items-center shadow-sm add-gown-btn"
                                data-bs-toggle="modal" data-bs-target="#addGownModal"
                                title="Add gowns">
                            <img src="../assets/images/kayaos.jpg" width="50px" alt="">
                            <span style="font-size: 15px; font-weight: 300;">Add Gown</span>
                        </button>
                    
                    </div>

             <!-- gowns -->   
             <?php include('read-gowns.php'); ?>
             <?php include('update-gown.php'); ?>

                          
             </div>


        </div>
    </div>

</div>
</body>
<!-- date time -->
<script src="../assets/js/datetime.js" ></script>  

<!-- TABLE DATA -->
     
<!-- SIDEBAR HIDE -->
<script src="../assets/js/sidebar.js"></script>

</html>