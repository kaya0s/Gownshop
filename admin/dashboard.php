<?php
session_start();
require('add-admin.php');
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
    <!-- Bootstrap Bundle includes Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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
                <li style=" background-color: rgb(24, 24, 24); border-radius: 5px;">
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
                    <button id="toggleSidebar" class="toggle-btn">☰</button>
                    <div class="greetAdmin" style="margin-left: 10px;" >
                        <h2>Welcome, Admin!</h2>  
                        <h6 id="dateTimeDisplay"></h6>   
                        </div>


                        
                </div>
                <div class="user-profile" style="margin-left: 50px;">
                    <span><?php if(isset($_SESSION['fullname'])){
                        echo $_SESSION['fullname']; 
                    }
                    ?> </span>
                    </span>
                    <img src="../assets/images/kayaos.jpg" alt="user">  

                </div>
            </div>
            
            <!-- content -->
            <div class="content">


                <div class="row"    >

                    <!-- Button trigger modal -->
               
                    <!-- STATISTICS -->
                    <div class="wew p-3" style="width: 25%; border-radius: 10px; background-color: white; box-shadow: 0 10px 25px rgba(21, 87, 81, 0.25);margin: 10px; margin-top:0px">
                        <div class="d-flex align-items-center">
                            <!-- Left Column: Text and Number -->
                            <div class="flex-grow-1">
                            <p class="mb-1" style="font-size: 18px; color: #555;">Total Sales</p>
                            <h1 style="font-size: 64px; font-weight: bold; color: #186864;">9</h1>
                            </div>
                            <!-- Right Column: Image -->
                            <img src="../assets/images/sales.png" alt="Gown icon" style="width: 70px;">
                        </div>
                        </div>

                        <div class="wew p-3" style="width: 25%; border-radius: 10px; background-color: white; box-shadow: 0 10px 25px rgba(21, 87, 81, 0.25);margin: 10px;margin-top:0px ">
                            <div class="d-flex align-items-center">
                                <!-- Left Column: Text and Number -->
                                <div class="flex-grow-1">
                                <p class="mb-1" style="font-size: 18px; color: #555;">Total customers</p>
                                <h1 style="font-size: 64px; font-weight: bold; color: #186864;">9</h1>
                                </div>
                                <!-- Right Column: Image -->
                                <img src="../assets/images/wallet.png" style="width: 60px;">
                        </div>
                        </div>

                        <div class="wew p-3" style="width: 25%; border-radius: 10px; background-color: white; box-shadow: 0 10px 25px rgba(21, 87, 81, 0.25);margin: 10px;margin-top:0px ">
                            <div class="d-flex align-items-center">
                                <!-- Left Column: Text and Number -->
                                <div class="flex-grow-1">
                                <p class="mb-1" style="font-size: 18px; color:rgb(146, 42, 42);">Unreturned Gowns</p>
                                <h1 style="font-size: 64px; font-weight: bold; color:rgb(146, 42, 42);">9</h1>
                                </div>
                                <!-- Right Column: Image -->
                                <img src="../assets/images/rejected.png" alt="Gown icon" style="width: 60px;">
                        </div>
                        </div>
                            

                        
                        <div class="d-flex gap-2 mt-4 mb-3"style="margin-left: 0px; margin-right: 20px;">
                            <button class="btn btn-outline-success active" onclick="loadTable('pending')">Pending</button>
                            <button class="btn btn-outline-primary" onclick="loadTable('booked')">Booked</button>
                            <button class="btn btn-outline-warning" onclick="loadTable('unreturned')">Unreturned</button>
                        </div>
            
                </div>

                <!-- TABLE -->
                    <div class="table-responsive" >
                        <table class="table table-bordered table-striped text-center">
                        <thead class="table-light">
                            <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Contact #</th>
                            <th>Item Name</th>
                            <th>Price</th>
                            <th>Release</th>
                            <th>Return</th>
                            <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <!-- Rows will be inserted here by JavaScript -->
                        </tbody>
                        </table>
                    </div>
                            
                            <br>
                 <!-- REVIEWS -->
                <div class="row" style=" border: 0.5px solid rgba(0, 0, 0, 0.2);  margin: 0; border-radius: 5px; padding-top: 10px; " >
                    <h3>Shop Reviews</h3>
                    <div class="mb-3"style="margin: 0px;">

                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" disabled>
                    </div>
                    <div class="mb-3" style="margin: 0px;">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled>sample message</textarea>
                    </div>
                    <!-- line break -->
                    <hr style="width: 98%;justify-content: center; margin: auto; margin-bottom: 10px;" > 

                </div>
                    
                
        </div>

        <!-- copyright footer -->
            
    </div>
    </div>

</body>
<!-- date time -->
<script src="../assets/js/datetime.js" ></script>  

<!-- TABLE DATA -->
<script src="../assets/js/tabledata.js"> </script>
     
<!-- SIDEBAR HIDE -->
<script src="../assets/js/sidebar.js"></script>
   


</html>