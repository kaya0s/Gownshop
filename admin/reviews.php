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
    <link rel="icon" href="../assets/images/HJ Logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    
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

                </li>
                <!-- gowns BUTTON IN SIDEBAR -->
                <li>
                    <a href="gowns.php">
                        <img src="../assets/images/icons/product.png" alt="dashboard">
                        <span>Gowns</span>
                    </a>
                </li>

                    <!-- REVIEWS  -->
                <li style=" background-color: rgb(93, 92, 92); border-radius: 5px;">
                    <a href="reviews.php" class="active">
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
                    <img src="../assets/images/kayaos.jpg" alt="user">  

                </div>
            </div>
            
            <!-- content -->
            <div class="content">


            <div class="row">

            <!-- Button trigger modal -->
            <?php 
            
            $query = mysqli_query($conn, "SELECT COUNT(*) AS total_reviews FROM reviews;");
            $row = mysqli_fetch_assoc($query);
            $totalReviews = $row['total_reviews'];
            
            ?>
            <!-- STATISTICS -->

            <div class="wew p-3" style="width: 25%; border-radius: 10px; background-color: white; box-shadow: 0 10px 25px rgba(21, 87, 81, 0.25);margin: 10px; margin-top:0px">
                <div class="d-flex align-items-center">
                    <!-- Left Column: Text and Number -->
                    <div class="flex-grow-1">
                    <p class="mb-1" style="font-size: 18px; color: #555;">Total Reviews</p>
                    <h1 style="font-size: 64px; font-weight: bold; color: #041623;"><?php echo $totalReviews?></h1>
                    </div>
                    <!-- Right Column: Image -->
                    <img src="../assets/images/icons/re_view.png" alt="Gown icon" style="width: 60px; height: 60px;">
                </div>
                </div>

            </div>
            <h3>Shop Reviews</h3>    
                <?php 
                $result = mysqli_query($conn, "SELECT reviews.*,users.* FROM reviews left join users on reviews.user_id =users.id");    
                while($row = mysqli_fetch_assoc($result)){
                ?>
                <br>
                 <!-- REVIEWS -->
                <div class="row" style=" border: 0.5px solid rgba(0, 0, 0, 0.2);  margin: 0; border-radius: 5px; padding-top: 10px; " >
                    
                    <div class="mb-3"style="margin: 0px;">

                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="<?php echo $row['email']?>" disabled>
                    </div>
                    <div class="mb-3" style="margin: 0px;">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled><?php echo $row['comment'] ?></textarea>
                    </div>
                    <!-- line break -->
                    <hr style="width: 98%;justify-content: center; margin: auto; margin-bottom: 10px;" > 
                </div>
            <?php }?>

                 
        </div>

        <!-- copyright footer -->
            
    </div>
    </div>

</body>
<!-- date time -->
<script src="../assets/js/datetime.js" ></script>  

     
<!-- SIDEBAR HIDE -->
<script src="../assets/js/sidebar.js"></script>
   


</html>