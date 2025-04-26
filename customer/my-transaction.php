<?php  session_start();?>
        
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
        <link rel="stylesheet" href="../assets/bootstrap-5.3.3-dist/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="../assets/css/customer.css">
        <link rel="stylesheet" href="../assets/css/alertmsg.css">
        
        
        
    </head>
    <body>
        <?php
          include_once('../includes/alertmsg.php');
        
        ?>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg ">
        
            <!-- Logo and Brand Name -->
            <a class="navbar-brand text-center "  href="#">
                <img style="height: 80px;" src="../assets/images/HJ Logo.png" alt="HJ Logo" class="logo-img">
                <h3 style="font-weight:400;" >HJ GOWNSHOP</h3>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">WEDDING DRESSES</a>
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
                        <span style="padding-right:10px;">Customer</span>
                        <i class="fas fa-user user-icon" style="padding-right:10px;"></i> 
                    </div>
                    
                </div>
            </div>
       
    </nav>

    <div class="bg-light text-dark">
        <div class="container py-5">
            <h1 class="text-center mb-5">My Transactions</h1>

             <!-- Suki Points Section -->
            <div class="alert alert-info text-center mb-5" style="font-family: 'Raleway';">
                <h5>You have <strong>120 Suki Points</strong> 💎</h5>
                <p>You can use your points to get discounts on future rentals!</p>
                <button class="btn btn-outline-primary">Use Points</button>
            </div>

            <div class="table-responsive bg-white rounded shadow-sm" style="font-family: 'Raleway'cursive;">
            <table class="table table-striped" style="font-family: 'Raleway'cursive;">
                <thead class="table-dark">
                <tr>
                    <th>Order Id</th>
                    <th>Date</th>
                    <th>Items</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>#123456</td>
                    <td>April 20, 2025</td>
                    <td>2 Gowns</td>
                    <td>$899.00</td>
                    <td><span class="badge bg-success">Delivered</span></td>
                    <td>
                    <button class="btn btn-primary btn-sm">View</button>
                    <button class="btn btn-secondary btn-sm">Invoice</button>
                    </td>
                </tr>
                <!-- More rows here -->
                </tbody>
            </table>
            </div>

            <!-- Detailed Order Section -->
            <div class="bg-white rounded shadow-sm p-4 mt-5" style="font-family: 'Raleway'cursive;">
            <h2>Order Details - #123456</h2>
            <div class="row mt-3">
                <div class="col-md-6">
                <p><strong>Order Date:</strong> April 20, 2025</p>
                <p><strong>Status:</strong> Delivered</p>
                <p><strong>Payment Method:</strong> Credit Card</p>
                </div>
                <div class="col-md-6">
                <p><strong>Shipping To:</strong><br>Jane Doe<br>123 Bridal Ave<br>Los Angeles, CA</p>
                </div>
            </div>

            <h5 class="mt-4">Items Ordered</h5>
            <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item d-flex justify-content-between">
                <span>Elegant Lace Gown x1</span>
                <span>$499.00</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                <span>Silk Mermaid Gown x1</span>
                <span>$400.00</span>
                </li>
            </ul>
            <div class="text-end mb-3">
                <strong>Total: $899.00</strong>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <button class="btn btn-outline-danger">Request Return</button>
                <button class="btn btn-outline-primary">Contact Support</button>
            </div>
            </div>
        </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</div>   
    
        


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

    </body>
    </html> 

