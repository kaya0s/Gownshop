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
</head>

<body>
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
                <!-- Button trigger modal -->
                <button type="button" class="btn d-flex align-items-center p-2 rounded" 
                        data-bs-toggle="modal" data-bs-target="#exampleModal"
                            style="width: 100%;" >
                    <img src="../assets/images/icons/admin.png" alt="dashboard" style="height: 30px;">
                    <span style="margin-left: 20px;font-size: 21.6px; ">Add admin</span>
                </button>

            </li>
            <li>
                <a  style=" background-color: rgb(24, 24, 24); border-radius: 5px;"href="product.html">
                    <img src="../assets/images/icons/product.png" alt="dashboard">
                    <span>Products</span>
                </a>
            </li>
            
            <li>
                <a href="../includes/logout.php">
                    <img src="../assets/images/icons/logout.png" alt="dashboard">
                    <span>Logout</span>
                </a>
            </li>
        </ul>
        </div>

        <!-- main-content -->
        <div class="main-content">


            <!-- Topbar -->
            <div class="topbar">
                <div class="dashGreet">
                    <button id="toggleSidebar" class="toggle-btn">☰</button>
                    <div class="greetAdmin" style="margin-left: 10px;" >
                        <h2>Welcome, Admin!</h2>  
                        <h6 id="dateTimeDisplay" style="margin-left: 5px;"></h6>   
                        </div>
                    

                        
                </div>
                <div class="user-profile" style="margin-left: 50px;">
                    <span>Erwin Lanzaderas</span>
                    <img src="icon.png" alt="user">

                </div>
            </div>
                
        <!-- content -->
        <div class="content" style="margin:0px 10px 10px 0px;" >
              
        <div class="row" style="margin:10px 10px 0px 10px; " >
            <!-- total products -->
            
                <div class="wew p-3" style="width: 25%; border-radius: 10px; background-color: white; box-shadow: 0 10px 25px rgba(21, 87, 81, 0.25);margin: 10px; margin-top: 0px;">
                    <div class="d-flex align-items-center">
                        <!-- Left Column: Text and Number -->
                        <div class="flex-grow-1">
                        <p class="mb-1" style="font-size: 18px; color: #555;">Total Gowns</p>
                        <h1 style="font-size: 64px; font-weight: bold; color: #186864;">9</h1>
                        </div>
                        <!-- Right Column: Image -->
                        <img src="icon.png" alt="Gown icon" style="width: 100px;">
                    </div>
                </div>

                <div class="wew p-3" style="width: 25%; border-radius: 10px; background-color: white; box-shadow: 0 10px 25px rgba(21, 87, 81, 0.25);margin: 10px;margin-top: 0px; ">
                    <div class="d-flex align-items-center">
                        <!-- Left Column: Text and Number -->
                        <div class="flex-grow-1">
                        <p class="mb-1" style="font-size: 18px; color: #555;">Total Gowns</p>
                        <h1 style="font-size: 64px; font-weight: bold; color: #186864;">9</h1>
                        </div>
                        <!-- Right Column: Image -->
                        <img src="icon.png" alt="Gown icon" style="width: 100px;">
                    </div>
                </div>

                <div class="wew p-3" style="width: 25%; border-radius: 10px; background-color: white; box-shadow: 0 10px 25px rgba(21, 87, 81, 0.25);margin: 10px; margin-top: 0px;">
                    <div class="d-flex align-items-center">
                        <!-- Left Column: Text and Number -->
                        <div class="flex-grow-1">
                        <p class="mb-1" style="font-size: 18px; color: #555;">Total Gowns</p>
                        <h1 style="font-size: 64px; font-weight: bold; color: #186864;">9</h1>
                        </div>
                        <!-- Right Column: Image -->
                        <img src="icon.png" alt="Gown icon" style="width: 100px;">
                    </div>
                </div>
                <button type="button" 
                        class="btn btn-outline-primary d-flex flex-column justify-content-center align-items-center shadow-sm add-gown-btn"
                        data-bs-toggle="modal" data-bs-target="#addGownModal"
                        title="Add Product">
                    <img src="icon.png" alt="">
                    <span style="font-size: 15px; font-weight: 300;">Add Gown</span>
                </button>
            
            </div>
                <div class="row" >
                    <h1 style="margin:0px 0px 0px 10px;" >GOWNS</h1>
                </div>
             <!-- PRODUCTS        -->
              <div class="row" style="justify-content:space-evenly;" >
    
                  <div class="card mb-3 card-hover gown-card" style="padding: 0px;margin: 10px;" >
                    <div class="row g-0">
                      <div class="col-md-7 img-container">
                        <img src="ChatGPT Image Apr 1, 2025, 11_52_59 PM.png" class="img-fluid rounded-start" alt="Gown Image">
                      </div>
                      <div class="col-md-5 d-flex align-items-center">
                        <div class="card-body">
                          <h5 class="card-title text-black">Elegant Red Gown</h5>
                          <p class="card-text text-black">
                            <strong>Size:</strong> Medium<br>
                            <strong>Category:</strong> Evening Gown<br>
                            <strong>Price:</strong> ₱1500 / day
                          </p>
                          <a style="background-color: #186864;border: none;" href="rent.php?gown_id=123" class="btn btn-primary w-100">Rent Now</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card mb-3 card-hover gown-card" style="padding: 0px;margin: 10px;" >
                    <div class="row g-0">
                      <div class="col-md-7 img-container">
                        <img src="ChatGPT Image Apr 1, 2025, 11_52_59 PM.png" class="img-fluid rounded-start" alt="Gown Image">
                      </div>
                      <div class="col-md-5 d-flex align-items-center">
                        <div class="card-body">
                          <h5 class="card-title text-black">Elegant Red Gown</h5>
                          <p class="card-text text-black">
                            <strong>Size:</strong> Medium<br>
                            <strong>Category:</strong> Evening Gown<br>
                            <strong>Price:</strong> ₱1500 / day
                          </p>
                          <a style="background-color: #186864;border: none;" href="rent.php?gown_id=123" class="btn btn-primary w-100">Rent Now</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card mb-3 card-hover gown-card" style="padding: 0px;margin: 10px;" >
                    <div class="row g-0">
                      <div class="col-md-7 img-container">
                        <img src="ChatGPT Image Apr 1, 2025, 11_52_59 PM.png" class="img-fluid rounded-start" alt="Gown Image">
                      </div>
                      <div class="col-md-5 d-flex align-items-center">
                        <div class="card-body">
                          <h5 class="card-title text-black">Elegant Red Gown</h5>
                          <p class="card-text text-black">
                            <strong>Size:</strong> Medium<br>
                            <strong>Category:</strong> Evening Gown<br>
                            <strong>Price:</strong> ₱1500 / day
                          </p>
                          <a style="background-color: #186864;border: none;" href="rent.php?gown_id=123" class="btn btn-primary w-100">Rent Now</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card mb-3 card-hover gown-card" style="padding: 0px;margin: 10px;" >
                    <div class="row g-0">
                      <div class="col-md-7 img-container">
                        <img src="ChatGPT Image Apr 1, 2025, 11_52_59 PM.png" class="img-fluid rounded-start" alt="Gown Image">
                      </div>
                      <div class="col-md-5 d-flex align-items-center">
                        <div class="card-body">
                          <h5 class="card-title text-black">Elegant Red Gown</h5>
                          <p class="card-text text-black">
                            <strong>Size:</strong> Medium<br>
                            <strong>Category:</strong> Evening Gown<br>
                            <strong>Price:</strong> ₱1500 / day
                          </p>
                          <a style="background-color: #186864;border: none;" href="rent.php?gown_id=123" class="btn btn-primary w-100">Rent Now</a>
                        </div>
                      </div>
                    </div>
                  </div>


                  

              </div>

               <!-- copyright -->
               <div class="footer" style="position: static; padding: 20px;text-align: center;align-items: center;">
                HJ gownshop ©copyright 2025 

            </div>
    


    </div>
    </div>





            <!-- Add Gown Modal -->
            <div class="modal fade" id="addGownModal" tabindex="-1" aria-labelledby="addGownLabel" aria-hidden="true">
                <div class="modal-dialog">
                <form method="POST" action="add_gown.php" enctype="multipart/form-data" class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="addGownLabel">Add New Gown</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <!-- Gown Name -->
                    <div class="mb-3">
                        <label class="form-label">Gown Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <!-- Gown Color -->
                    <div class="mb-3">
                        <label class="form-label">Color</label>
                        <input type="text" name="color" class="form-control" required>
                    </div>
                    <!-- Gown Size -->
                    <div class="mb-3">
                        <label class="form-label">Size</label>
                        <input type="text" name="size" class="form-control" placeholder="Bust, Waist, Hips, Length" required>
                    </div>
                    <!-- Price -->
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" name="price" class="form-control" step="0.01" required>
                    </div>
                    <!-- Image -->
                    <div class="mb-3">
                        <label class="form-label">Upload Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*" required>
                    </div>
                    </div>
                    <div class="modal-footer">
                    <button type="submit" name="addGown" class="btn btn-success">Save Gown</button>
                    </div>
                </form>
                </div>
            </div>




            <!--add admin Modal -->
            
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <form class="form-group" action="ambot.html" ></form>
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel" >Add admin</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            
                                <label for="firstname">First Name</label>
                                <input type="text" name="firsname" class="form-control" required>
                                <label for="lastname">Last Name</label>
                                <input type="text" name="lastname" class="form-control" required>
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" required>
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control"required >
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" required>
                                <label for="repassword">Confirm Password</label>
                                <input type="repassword" name="password" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <input type="submit" value="ADD" name="add-admin" class="btn btn-primary" style="background-color: #186864; border-color: #186864;">
                        </div>
                        </form>
                    </div>
                    </div>
                </div>
           
        
        </div>
</body>
<!-- date time -->
<script src="../assets/js/datetime.js" ></script>  


     
<!-- SIDEBAR HIDE -->
<script src="../assets/js/sidebar.js"></script>


<style>
    .add-gown-btn {
        width: 130px;
        height: 80px;
        border-radius: 10px;
        margin: 40px 10px 0px 1%;
        border-color: #186864;
        background-color: #186864;
        color: white;
        transition: all 0.3s ease;
    }

    .add-gown-btn:hover {
        background-color: #155d5b;
        border-color: #155d5b;
        color: #ffffff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        transform: scale(1.05);
    }
  

    .add-gown-btn:active,
    .add-gown-btn:focus:active {
    background-color: whitesmoke;
    border-color: #186864;
    color: #155d5b;
    box-shadow: none;
    outline: none;
}
</style>
  <style>
    .card-hover .img-container img {
      transition: transform 0.3s ease-in-out;
    }
  
    .card-hover:hover .img-container img {
      transform: scale(1.05); /* Add the transformation effect */
      z-index: 1;
    }
  
    .gown-card {
      max-width: 30%;
      width: 100%;
      margin: auto;
      border-radius: 10px;
    }
  
    .img-container {
      height: 100%;
      max-height: 300px;
      overflow: hidden;
    }
  
    .img-container img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border: none; /* Ensures no border */
    }
  </style>
</html>