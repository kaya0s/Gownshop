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
</style>
<body>
    <nav class="navbar navbar-expand-lg ">
        
        <!-- Logo and Brand Name -->
        <a class="navbar-brand text-center "  href="dashboard.php">
            <img style="height: 80px;" src="../assets/images/HJ Logo.png" alt="HJ Logo" class="logo-img">
            <h3 class="company-name" style="font-weight:400;" >HJ GOWNSHOP</h3>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php#gown-latest">WEDDING DRESSES</a>
                </li>
                <!-- New Gown Categories Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        GOWN CATEGORIES
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item"  href="dashboard.php#gown-wedding">WEDDING GOWNS</a></li>
                        <li><a class="dropdown-item" href="dashboard.php#gown-evening">EVENING GOWNS</a></li>
                        <li><a class="dropdown-item" href="dashboard.php#gown-debut">DEBUT GOWN</a></li>
                        <li><a class="dropdown-item" href="dashboard.php#gown-ball">BALL GOWN</a></li>
                        <li><a class="dropdown-item" href="dashboard.php#gown-cocktail">COCKTAIL GOWN</a></li>
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

 
            <div class="user-container" onclick="toggleDropdown()">
                <div class="user-info">
                    <span style="padding-right:10px;">customer</span>
                    <i class="fas fa-user user-icon" style="padding-right:10px;"></i> 
                </div>
                <div class="dropdown" id="userDropdown">
                    <a href="#">Sukid Points: 100</a>
                    <a href="#">Logout</a>
                </div>
            </div> 
            
            
            


                </div>
        </div>
    </nav>

    <!-- TOGGLE USER DROP DOWN -->
    <script src="../assets/js/toggleDropdown.js" ></script>