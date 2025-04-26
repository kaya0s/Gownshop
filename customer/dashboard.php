<?php  session_start();?>
<?php include('../includes/connection_db.php')?>   
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
        <?php
          include_once('../includes/alertmsg.php');
        
        ?>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg ">
        
            <!-- Logo and Brand Name -->
            <a class="navbar-brand text-center "  href="#">
                <img style="height: 80px;" src="../assets/images/HJ Logo.png" alt="HJ Logo" class="logo-img">
                <h3 class="company-name" style="font-weight:400;" >HJ GOWNSHOP</h3>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#gown-section">WEDDING DRESSES</a>
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
                    <li class="nav-item">
                        <a class="nav-link" href="my-transaction.php">MY TRANSACTIONS</a>
                    </li>
                </ul>
                <!-- User Info and Search -->
                <div class="navbar-right">
                <div class="search-container">
                        <input type="text" class="form-control search-input" placeholder="Search...">
                        <i class="fas fa-search search-icon"></i>
                    </div>
                    <div class="user-info">
                        <span style="padding-right:10px;">KAYAOS</span>
                        <i class="fas fa-user user-icon" style="padding-right:10px;"></i> 
                    </div>
                    
                </div>
            </div>
       
    </nav>

        <!-- Hero Section with Video Background -->
        <section class="hero-section">
            <!-- Due to platform limitations, a placeholder video is used. In a real implementation, replace with your actual wedding dress video -->
            <video class="video-background" autoplay loop muted playsinline>
                <source src="../asset/videos/gown.mp4" type="video/mp4">
                <!-- For demonstration purposes only, as we can't include external videos -->
            </video>
            <div class="video-overlay"></div>
            <div class="hero-content">
                <h1>ENCHANTING ELEGANCE</h1>
                <p>REDEFINING GLAMOUR, ONE GOWN AT A TIME</p>
               <a href="#gown-section"><button class="btn btn-discover">EXPLORE OUR LATEST COLLECTION</button></a> 
            </div>
        </section>

        <!-- Wedding Gowns Section -->
        <section class="gown-section " id="gown-section" style="scroll-margin-top: 80px;">
            
                <div class="container"  style="display:flex; width: 100%; flex-direction: column;" >
                        <div class="section-title" >
                            <h2>OUR WEDDING GOWNS</h2>
                            <p>Explore our exquisite collection of handcrafted bridal dresses</p>
                        </div>
                </div>
            <div class="container-fluid mt-5 px-4" style="margin-top: 10px !important;">
                 <div class="row g-4" style="padding: 0 20px 0 20px; margin-top: -10px;">
                            <?php
                            $result=mysqli_query($conn,"Select * from gowns where available = 1 order by id desc;");
                            if(mysqli_num_rows($result ) > 0){
                                
                    while($row = mysqli_fetch_assoc($result)){
                        $sizes = explode(',',$row['size']);
                        ?>
                    
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 text-center" onclick='openDrawer(
                                            <?php echo json_encode($row["name"]); ?>,
                                        <?php echo json_encode($row["description"]); ?>,
                                        <?php echo json_encode($row["color"]); ?>,
                                        <?php echo json_encode($sizes); ?>
                                                        )'>
                            <img src="../uploads/gowns/<?php echo $row['image']; ?>" class="img-thumbnail custom-image" alt="This is the Gown Image"  style="width: 100%; height: 645px; object-fit: cover;">
                            <h5 class="mt-2 text-start" style="color:rgba(0, 0, 0, 0.7); font-weight: bold;" ><?php echo $row['name']; ?></h5>
                        </div>

                        <?php
                    }
                    

                            }else{
                                echo "No Gowns Found";
                            }
                            
                            ?>

                </div>
            </div>
        </section>
          
        
        <!-- Drawer Overlay view gown -->
        <div class="drawer-overlay" id="drawerOverlay" onclick="closeDrawer()"></div>
        
        <!-- Drawer Panel  view gown panel-->
        <div class="drawer p-4" id="drawerPanel">
            <div class="d-flex justify-content-between align-items-center mb-3" style="padding-left: 3.5rem;">
                <h4 class="mb-0" id="gownName"></h4>
                <!-- GOWNNAME -->
                <button class="btn btn-outline-secondary" onclick="closeDrawer()"><i class="bi-x-lg"></i></button>
            </div>
            <div class="img-description-container" sty>
                
                <!-- description etc section -->
                <div class="col-4 col-5-lg col-12-md">
                    <form action="">
                       
                        <div class="mb-3 mt-3 info-container">
                            <!-- gown description here -->
                            <div class="m-b-32 description-box">
                                <p id="description" style="margin: 0px;">
                                   <!-- description -->
                                </p>
                            </div>

                            <!-- sizes options -->
                            <div class="size-container">
                                <div class="size">
                                    <h6 class="title-size">Bust</h6>
                                    <input class="size-input" id="size-bust" type="text" placeholder="size" disabled>
                                </div>
                                <div class="size">
                                    <h6 class="title-size">Waist</h6>
                                    <input class="size-input"  id="size-waist" type="text"  placeholder="size" disabled>
                                </div>
                                <div class="size">
                                    <h6 class="title-size">Hips</h6>
                                    <input  class="size-input" id="size-hips" type="text"  placeholder="size" disabled>
                                </div>
                                <div class="size">
                                    <h6 class="title-size">Length</h6>
                                    <input class="size-input"  id="size-length" type="text"  placeholder="size" disabled>
                                </div>
                                
                            </div> 
                            
                           <div style="width: 100%; border-top: 3px solid #186864; margin-top: 10px; font-family: 'Raleway'cursive   ;">
                           <div class="size" style="margin-top: 10px;">
                                    <h6 class="title-size"  >Color</h6>
                                    <input style="width:fit-content" id="gown-color" class="size-input" type="text" placeholder="Golden White" disabled>
                                </div>
                           </div>

                        </div>
                        
                        <button style="background-color: #186864 !important; width: 100%; border-radius: 2px;" type="submit" class="btn btn-success" >Rent Now</button>
                    </form>
                </div>
                <!-- image container -->
                <div class="img-container">
                        <img src="../assets/images/gown1.jpg" class="img-fluid" alt="Gown Image" style=" height: auto; object-fit: cover;">
                    </div>
            </div>
        </div>
       s

        <!-- Footer -->
        <footer class="text-white py-5"style="background-color: #041623;">
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
                        <ul class="list-unstyled footer-list">
                            <li><a href="#" class="text-white" >Wedding Dresses</a></li>
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

        <!-- this is the drawer panel scripting -->
        <script>
            const drawerPanel = document.getElementById('drawerPanel');
            const drawerOverlay = document.getElementById('drawerOverlay');

            function openDrawer(name,description,color,sizes) {
            
            drawerPanel.classList.add('active');
            drawerOverlay.classList.add('active');
            document.getElementById("gownName").innerText = name;
            document.getElementById("description").innerText = description;
            document.getElementById("gown-color").value = color;
            document.getElementById("size-bust").value = sizes[0];
            document.getElementById("size-waist").value = sizes[1];
            document.getElementById("size-hips").value = sizes[2];
            document.getElementById("size-length").value = sizes[3];
            }

            function closeDrawer() {
            drawerPanel.classList.remove('active');
            drawerOverlay.classList.remove('active');
            }
        </script>
    </body>
    </html> 

