<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HJ GOWNSHOP - Wedding Dresses</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome for icons -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../assets/bootstrap-5.3.3-dist/css/bootstrap.min.css">
        <style>
        *{
            margin: 0;    
        }
        body{
            padding-top: 80px; /* Add padding to body to account for fixed navbar */
            background-color: #f8f9fa;
        }
        .navbar {
            
            padding: 10px;
            background-color:#186864;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }
        
        .navbar-brand {
            display: flex;
            align-items: center;
            font-weight: 700;
            font-size: 1.5rem;
            color: #fff;
            
        }
        
        .navbar-brand img {
            margin-right: 10px;
            transition: transform 0.3s ease;
        }
        
        .navbar-brand:hover img {
            transform: scale(1.05);
        }
        
        .nav-link {
            font-weight: 500;
            color: #fff !important;
            padding: 10px 15px !important;
            transition: color 0.3s ease;
        }
        
        .nav-link:hover, .nav-link:focus {
            color: #f8f9fa !important;
        }
        
        .dropdown-menu {
            background-color: #343a40;
            border: none;
        }
        
        .dropdown-item {
            color: #fff !important;
            padding: 8px 20px;
        }
        
        .dropdown-item:hover {
            background-color: #495057;
            color: #fff !important;
        }
        
        .navbar-right {
            display: flex;
            align-items: center;
            
        }
        
        .user-info {
            display: flex;
            align-items: center;
            color: #fff;
            cursor: pointer;
            margin-left:50px;
        }
        
        .user-icon {
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }
        
        .user-info:hover .user-icon {
            transform: scale(1.1);
        }
        
        .search-container {
            position: relative;
            width: 200px;
        }
        
        .search-input {
            padding-right: 35px;
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
        }
        
        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }
        
        .search-input:focus {
            background-color: rgba(255, 255, 255, 0.2);
            color: #fff;
            border-color: rgba(255, 255, 255, 0.3);
            box-shadow: none;
        }
        
        .search-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.6);
            pointer-events: none;
        }
        
        /* Responsive adjustments */
        @media (max-width: 992px) {
            .navbar-collapse {
                padding-top: 15px;
            }
            
            .navbar-right {
                margin-top: 15px;
                padding-bottom: 15px;
                width: 100%;
                justify-content: space-between;
            }
            
            .search-container {
                width: calc(100% - 100px);
            }
        }
        
        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1.2rem;
            }
            
            .navbar-brand img {
                height: 60px;
            }
            
            .search-container {
                width: 100%;
                margin-top: 10px;
            }
            
            .user-info {
                margin-right: 0;
                margin-bottom: 10px;
            }
        }
            .hero-section {
                height: 90vh;
                position: relative;
                color: white;
                display: flex;
                align-items: center;
                overflow: hidden;
            }
            
            .video-background {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                object-fit: cover;
                z-index: -1;
            }
            
            .video-overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 0;
            }
            
            .hero-content {
                padding-left: 5%;
                position: absolute;
                z-index: 1;
                bottom: 20%;
            }
            
            .hero-content h1 {
                font-size: 3.5rem;
                font-weight: 300;
                letter-spacing: 2px;
            }
            
            .hero-content p {
                font-size: 1.2rem;
                margin-top: 1rem;
                font-weight: 300;
                letter-spacing: 1px;
            }
            
            .btn-discover {
                background-color: transparent;
                border: 1px solid white;
                color: white;
                padding: 10px 25px;
                margin-top: 20px;
                letter-spacing: 1px;
                transition: all 0.3s;
            }
            
            .btn-discover:hover {
                background-color: white;
                color: #0a1a2a;
            }
            
            .gown-card {
                margin-bottom: 30px;
                transition: transform 0.3s;
                cursor: pointer;
            }
            
            .gown-card:hover {
                transform: translateY(-10px);
            }
            
            .gown-card img {
                border-radius: 5px;
                height: 350px;
                object-fit: cover;
                width: 100%;
            }
            
            .gown-card h5 {
                margin-top: 15px;
                font-weight: 500;
            }
            
            .gown-card p {
                color: #666;
                font-size: 0.9rem;
            }
            
            .gown-section {
                padding: 60px 0;
                background-color: #f8f9fa;
            }
            
            .section-title {
                margin-bottom: 25px;
                text-align: center;
            }
            
            .section-title h2 {
                font-weight: 300;
                letter-spacing: 2px;
            }
        </style>
    </head>
    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg ">
        <div class="container" >
            <!-- Logo and Brand Name -->
            <a class="navbar-brand" href="#">
                <img style="height: 80px;" src="../assets/images/HJ Logo.png" alt="HJ Logo" class="logo-img">
                HJ GOWNSHOP
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">WEDDING DRESSES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">SUKI POINTS</a>
                    </li>
                    <!-- New Gown Categories Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            GOWN CATEGORIES
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">A-LINE GOWNS</a></li>
                            <li><a class="dropdown-item" href="#">BALL GOWNS</a></li>
                            <li><a class="dropdown-item" href="#">MERMAID STYLE</a></li>
                            <li><a class="dropdown-item" href="#">SHEATH DRESSES</a></li>
                            <li><a class="dropdown-item" href="#">OFF-SHOULDER</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- User Info and Search -->
                <div class="navbar-right">
                <div class="search-container">
                        <input type="text" class="form-control search-input" placeholder="Search...">
                        <i class="fas fa-search search-icon"></i>
                    </div>
                    <div class="user-info">
                        <span style="padding-right:10px;">Customer</span>
                        <i class="fas fa-user user-icon" style="padding-right:10px;"></i> 
                    </div>
                    
                </div>
            </div>
        </div>
    </nav>

        <!-- Hero Section with Video Background -->
        <section class="hero-section">
            <!-- Due to platform limitations, a placeholder video is used. In a real implementation, replace with your actual wedding dress video -->
            <video class="video-background" autoplay loop muted playsinline>
                <source src="../assts/videos/gown.mp4" type="video/mp4">
                <!-- For demonstration purposes only, as we can't include external videos -->
            </video>
            <div class="video-overlay"></div>
            <div class="hero-content">
                <h1>SLEEPING BEAUTY</h1>
                <p>AWAKENING THE ROMANCE OF THE VINTAGE FLAIR</p>
                <button class="btn btn-discover">DISCOVER THE NEW COLLECTION</button>
            </div>
        </section>

        <!-- Wedding Gowns Section -->
        <section class="gown-section">
        <div class="container" style="display:flex; width: 100%; flex-direction: column;" >
                <div class="section-title" >
                    <h2>OUR WEDDING GOWNS</h2>
                    <p>Explore our exquisite collection of handcrafted bridal dresses</p>
                    </div>
            </div>
            <div class="container-fluid mt-5 px-4" style="margin-top: 10px !important;">
                <div class="row g-4" style="padding: 0 20px 0 20px; margin-top: -10px;">
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 text-center">
                        <img src="../assets/../assets/images/gown1.jpg" class="img-thumbnail custom-image" alt="This is the Gown Image" style="object-fit: cover;">
                        <h5 class="mt-2 text-start">Casual Mini Skirt</h5>
                    </div>
                    
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 text-center">
                        <img src="../assets/images/gown1.jpg" class="img-thumbnail custom-image" alt="This is the Gown Image" style="object-fit: cover;">
                        <h5 class="mt-2 text-start">Casual Mini Skirt</h5>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 text-center">
                        <img src="../assets/images/gown1.jpg" class="img-thumbnail custom-image" alt="This is the Gown Image" style="object-fit: cover;">
                        <h5 class="mt-2 text-start">Casual Mini Skirt</h5>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 text-center">
                        <img src="../assets/images/gown1.jpg" class="img-thumbnail custom-image" alt="This is the Gown Image" style="object-fit: cover;">
                        <h5 class="mt-2 text-start">Casual Mini Skirt</h5>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 text-center">
                        <img src="../assets/images/gown1.jpg" class="img-thumbnail custom-image" alt="This is the Gown Image" style="object-fit: cover;">
                        <h5 class="mt-2 text-start">Casual Mini Skirt</h5>
                    </div>
                </div>
            </div>
        </section>
            
            
                
             

        <!-- Footer -->
        <footer class="bg-dark text-white py-5">
            <div class="container"  >
                <div class="row">
                    <div class="col-md-4">
                        <h5>HJ GOWNSHOP</h5>
                        <p>Creating dream wedding dresses since 2013</p>
                        <div class="social-icons">
                            <i class="fab fa-facebook me-3"></i>
                            <i class="fab fa-instagram me-3"></i>
                            <i class="fab fa-pinterest me-3"></i>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5>QUICK LINKS</h5>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-white">Wedding Dresses</a></li>
                            <li><a href="#" class="text-white">Gown Categories</a></li>
                            <li><a href="#" class="text-white">Store Finder</a></li>
                            <li><a href="#" class="text-white">About Us</a></li>
                            <li><a href="#" class="text-white">Contact</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>CONTACT US</h5>
                        <ul class="list-unstyled">
                            <li>Email: info@hjgownshop.com</li>
                            <li>Phone: +1 (800) 555-0123</li>
                            <li>Address: 1234 Bridal Lane, New York, NY 10001</li>
                        </ul>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col text-center">
                        <p>© 2025 HJ GOWNSHOP. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Bootstrap JS Bundle with Popper -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/js/autoloadvideo.js" ></script>
        
    </body>
    </html> 

