<?php 
session_start();
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HJ GOWNSHOP</title>
        <link rel="icon" href="../assets/images/HJ Logo.png">
        <!-- Bootstrap CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome for icons -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="../assets/bootstrap-5.3.3-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/customer.css">
        <link rel="stylesheet" href="../assets/css/alertmsg.css">
    </head>
    <style>
    html {
    scroll-behavior: smooth;
    }
    .company-name {
        font-family: 'aboreto';
        font-weight:400 ;
        color: white;
    }
</style>
<body>
    <nav class="navbar navbar-expand-lg ">
        
        <!-- Logo and Brand Name -->
        <a class="navbar-brand text-center "  href="homepage.php">
            <img style="height: 80px;" src="../assets/images/HJ Logo.png" alt="HJ Logo" class="logo-img">
            <h3 class="company-name" style="font-weight:400;" >HJ GOWNSHOP</h3>
        </a>
        
        <button style="border:1px solid white;" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span style="color:white;" class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="homepage.php#gown-latest">LATEST COLLECTIONS</a>
                </li>
                <!-- New Gown Categories Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        GOWN CATEGORIES
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item"  href="homepage.php#gown-wedding">WEDDING GOWNS</a></li>
                        <li><a class="dropdown-item" href="homepage.php#gown-evening">EVENING GOWNS</a></li>
                        <li><a class="dropdown-item" href="homepage.php#gown-debut">DEBUT GOWN</a></li>
                        <li><a class="dropdown-item" href="homepage.php#gown-ball">BALL GOWN</a></li>
                        <li><a class="dropdown-item" href="homepage.php#gown-cocktail">COCKTAIL GOWN</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="my-transaction.php">MY TRANSACTIONS</a>
                </li>
            </ul>
            <!-- User Info and Search -->
            <div class="navbar-right">
            
            <div class="search-container">
                <input type="text" class="form-control search-input" placeholder="Search..." id="searchBox">
                <i class="fas fa-search search-icon" onclick="searchAndScroll()"></i>
            </div>

 
            <div class="customer-container"  onclick="toggleCustomerDropdown()">
                <div class="customer-info">
                    <span style="padding-right:10px;"><?php echo $_SESSION['fullname'];?></span>
                    <i class="fas fa-user user-icon" style="padding-right:10px;"></i> 
                </div>

                <?php
                    $result = mysqli_query($conn,"SELECT suki_points FROM users WHERE id = ".$_SESSION['user_id'].";");
                    $row = mysqli_fetch_assoc($result);
                    $_SESSION['suki_points'] = $row['suki_points'];
                ?>
                <div class="customer-dropdown" id="customerDropdown">
                    <a href="#"> Suki Points: <br> <h5><i class="fas fa-coins me-2"></i><?php echo $row['suki_points']?></h5></a>
                    <hr>
                    <a href="../auth/logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
                </div>
            </div>

            
            
            


                </div>
        </div>
    </nav>

    <!-- USER DROP DOWN -->
<script src="../assets/js/customer-dropdown.js" ></script>

<style>


</style>
