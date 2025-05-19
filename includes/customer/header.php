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
                <?php if(isset($_SESSION['fullname'])){?>
                <li class="nav-item">
                    <a class="nav-link" href="my-transaction.php">MY TRANSACTIONS</a>
                </li>
                 <?php }?>
            </ul>
            <!-- User Info and Search -->
            <div class="navbar-right">
            <div class="search-container">
                <input type="text" class="form-control search-input" placeholder="Search..." id="searchBox">
                <i class="fas fa-search search-icon" onclick="searchGowns()"></i>
                <div id="searchResults" class="search-results"></div>
            </div>

            <?php if(isset($_SESSION['fullname'])){?>
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
                    
                    <a href="#"> Suki Points: <br> <h5><i class="fas fa-coins me-2"></i><?php if(isset($_SESSION['user_id']))  echo $row['suki_points'];?></h5></a>
                    <hr>
                    <a href="../auth/logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
                </div>
            </div>
            <?php
             }else{
            ?>
              <a style="background-color: white;" href="../index.php" class="btn  border-0 rounded-0 px-4 py-2 text-decoration-none ms-5 mx-3">
                Login
                </a>
             <?php
             }
            ?>

                </div>
        </div>
    </nav>

    <!-- USER DROP DOWN -->
<script src="../assets/js/customer-dropdown.js" ></script>

<style>
    .search-container {
        position: relative;
        margin-right: 20px;
    }

    .search-input {
        padding-right: 40px;
        border: 1px solid #ddd;
        width: 200px;
    }

    .search-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #666;
        cursor: pointer;
    }

    .search-results {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        max-height: 400px;
        overflow-y: auto;
        z-index: 1000;
        display: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .search-result-item {
        display: flex;
        align-items: center;
        padding: 10px;
        border-bottom: 1px solid #eee;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .search-result-item:hover {
        background-color: #f8f9fa;
    }

    .search-result-item img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        margin-right: 10px;
        border-radius: 4px;
    }

    .search-result-item .gown-info {
        flex: 1;
    }

    .search-result-item .gown-name {
        font-weight: bold;
        margin: 0;
        color: #333;
    }

    .search-result-item .gown-price {
        color: #666;
        font-size: 0.9em;
        margin: 0;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function searchGowns() {
        const searchBox = document.getElementById('searchBox');
        const searchResults = document.getElementById('searchResults');
        const query = searchBox.value.trim();

        if (query.length < 2) {
            searchResults.style.display = 'none';
            return;
        }

        // Fetch search results from the server
        fetch(`search_gowns.php?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                if (data.length === 0) {
                    searchResults.innerHTML = '<div class="search-result-item">No gowns found</div>';
                } else {
                    searchResults.innerHTML = data.map(gown => `
                        <div class="search-result-item" onclick='window.openDrawer(
                            ${JSON.stringify(gown.id)},
                            ${JSON.stringify(gown.name)},
                            ${JSON.stringify(gown.description)},
                            ${JSON.stringify(gown.image)},
                            ${JSON.stringify(gown.color)},
                            ${JSON.stringify(gown.price)},
                            ${JSON.stringify(gown.sizes)}
                        )'>
                            <img src="../uploads/gowns/${gown.image}" alt="${gown.name}">
                            <div class="gown-info">
                                <p class="gown-name">${gown.name}</p>
                                <p class="gown-price">₱${gown.price}</p>
                            </div>
                        </div>
                    `).join('');
                }
                searchResults.style.display = 'block';
            })
            .catch(error => {
                console.error('Error:', error);
                searchResults.innerHTML = '<div class="search-result-item">Error searching gowns</div>';
                searchResults.style.display = 'block';
            });
    }

    // Add event listener to search box
    const searchBox = document.getElementById('searchBox');
    searchBox.addEventListener('input', searchGowns);

    // Close search results when clicking outside
    document.addEventListener('click', function(event) {
        const searchContainer = document.querySelector('.search-container');
        const searchResults = document.getElementById('searchResults');
        
        if (!searchContainer.contains(event.target)) {
            searchResults.style.display = 'none';
        }
    });
});
</script>
