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
        
        <div class="sidebar">
            <div class="heads">
                <img style="border-radius: 50%;box-shadow: 0px 4px 8px rgb(0, 0, 0,0.3);" src="../assets/images/HJ Logo.png" alt="logo">
            </div>
            <ul class="menu">
                <li style=" background-color: rgb(24, 24, 24); border-radius: 5px;">
                    <a href="index.html" class="active">
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
                    <a href="products.php">
                        <img src="../assets/images/icons/product.png" alt="dashboard">
                        <span>Product</span>
                    </a>
                </li>
                
                <li>
                    <a href="../index.html">
                        <img src="../assets/images/icons/logout.png" alt="dashboard">
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>


        <div class="main-content">
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
                    <img src="../assets/images/kayaos.jpg" alt="user">

                </div>
            </div>
            
            <!-- content -->
            <div class="content">


              
                
                <div class="row" style="margin-left: 10px;" >

                    <!-- Button trigger modal -->
               
                    <!-- STATISTICS -->
                    <div class="wew p-3" style="width: 25%; border-radius: 10px; background-color: white; box-shadow: 0 10px 25px rgba(21, 87, 81, 0.25);margin: 10px; ">
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

                        <div class="wew p-3" style="width: 25%; border-radius: 10px; background-color: white; box-shadow: 0 10px 25px rgba(21, 87, 81, 0.25);margin: 10px; ">
                            <div class="d-flex align-items-center">
                                <!-- Left Column: Text and Number -->
                                <div class="flex-grow-1">
                                <p class="mb-1" style="font-size: 18px; color: #555;">Pending bookings</p>
                                <h1 style="font-size: 64px; font-weight: bold; color: #186864;">9</h1>
                                </div>
                                <!-- Right Column: Image -->
                                <img src="../assets/images/wallet.png" style="width: 60px;">
                        </div>
                        </div>

                        <div class="wew p-3" style="width: 25%; border-radius: 10px; background-color: white; box-shadow: 0 10px 25px rgba(21, 87, 81, 0.25);margin: 10px; ">
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
                    <div class="table-responsive" style="margin-left: 20px; margin-right: 20px;">
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
                <div class="row" style=" border: 0.5px solid rgba(0, 0, 0, 0.2); width: 97%; margin: 0 auto; border-radius: 5px; padding-top: 10px; " >
                    <h3>Shop Reviews</h3>
                    <div class="mb-3"style="margin: 0px;">

                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" disabled>
                    </div>
                    <div class="mb-3" style="margin: 0px;">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled>sample message</textarea>
                    </div>
                    <!-- line break -->
                    <hr style="width: 98%;justify-content: center; margin: auto; margin-bottom: 10px;" > 

                    <div class="mb-3"style="margin: 0px;">
                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" disabled>
                    </div>
                    <div class="mb-3" style="margin: 0px;">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled>sample message</textarea>
                    </div>
                </div>

            
                    <!-- copyright -->
                <div class="footer" style="position: static; padding: 20px;text-align: center;align-items: center;">
                    HJ gownshop ©copyright 2025 

                </div>
            

        </div>

    
    </div>
    </div>




    <!-- Modal -->
            <form class="form-group" action="add-addmin.php" method="post" >
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
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
                    </div>
                    </div>
                </div>
           </form>

</body>

   

<script>
    const tableData = {
      pending: [
        { name: 'Mark', address: 'Otto', contact: '@mdo', item: 'Gown A', price: '₱1000', release: '2024-04-01', return: '2024-04-05', status: 'Pending' },
        { name: 'Anna', address: 'Dela Cruz', contact: '@anna', item: 'Dress B', price: '₱1500', release: '2024-04-02', return: '2024-04-06', status: 'Pending' },
      ],
      booked: [
        { name: 'Jhon', address: 'Smith', contact: '@jsmith', item: 'Suit X', price: '₱2000', release: '2024-04-03', return: '2024-04-07', status: 'Booked' },
      ],
      unreturned: [
        { name: 'Ella', address: 'Baylon', contact: '@ella', item: 'Gown C', price: '₱1800', release: '2024-03-30', return: '---', status: 'Unreturned' },
      ],
    };
    
    function loadTable(status) {
      const tbody = document.getElementById('table-body');
      tbody.innerHTML = ''; // Clear table
    
      const data = tableData[status] || [];
      data.forEach((row, index) => {
        tbody.innerHTML += `
          <tr>
            <td>${index + 1}</td>
            <td>${row.name}</td>
            <td>${row.address}</td>
            <td>${row.contact}</td>
            <td>${row.item}</td>
            <td>${row.price}</td>
            <td>${row.release}</td>
            <td>${row.return}</td>
            <td>${row.status}</td>
          </tr>
        `;
      });
    
      // Optional: update button styling to show active
      document.querySelectorAll('button').forEach(btn => btn.classList.remove('active'));
      event.target.classList.add('active');
    }
    
    // Load "pending" by default
    window.onload = () => loadTable('pending');
    </script>
<script>
    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebar = document.querySelector('.sidebar');
  
    toggleBtn.addEventListener('click', () => {
      sidebar.classList.toggle('active');
    });
  </script>


<!-- date time -->
<script src="../assets/js/datetime.js" ></script>
  

</html>