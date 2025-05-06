<?php 
//  DATABASE CONNECTION
 include('../includes/connection_db.php');
 
    // HEADER AND NAVIGATION
 require_once('../includes/customer/header.php');
?>     

    <?php include_once('../includes/alertmsg.php'); ?>

    <div class="bg-light text-dark">
        <div class="container py-5">
            <h1 class="text-center mb-5">My Transactions</h1>

             <!-- Suki Points Section -->
            <div class="alert alert-info text-center mb-5" style="font-family: 'Raleway';">
                
                <h5>You have <strong><?php echo $_SESSION['suki_points'];?> </strong> Suki Points💎</h5>
                <p>You can use your points to get discounts on future rentals!</p>
                <button class="btn btn-outline-info"><a style="color:green; text-decoration: none; " href="homepage.php#gown-latest">Rent Now</a></button>
            </div>

            <div class="table-responsive bg-white rounded shadow-sm" style="font-family: 'Raleway'cursive;">
            <table class="table table-striped" style="font-family: 'Raleway'cursive;">
                <thead class="table-dark">
                <tr>
                    <th>Transaction Id</th>
                    <th>Gown Name</th>
                    <th>Date Rented</th>
                    <th>Total</th>
                    <th>Payment Method</th>
                    <th>Status</th> 

                </tr>
                </thead>
                <tbody>
                
                   <!-- FETCH TRANSCATIONS  -->
                <?php 
                    $stmt = $conn->prepare("SELECT gowns.name, transactions.*
                    FROM gowns
                    LEFT JOIN transactions ON gowns.id = transactions.gown_id 
                    WHERE transactions.user_id = ?");
                        $stmt->bind_param("i", $_SESSION['user_id']);
                        $stmt->execute();
                        $result = $stmt->get_result();
                    while($row = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                    <?php
                    
                    ?>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['date_booked']; ?></td>
                    <td><?php echo $row['total_price']; ?></td>
                    <td><?php echo $row['payment_method']; ?></td>
                    <td>        
                    <span class="badge bg-success"><?php echo $row['status']; ?></span>
                
                    </td>
                
                </tr>
                <?php } ?>
                <!-- More rows here -->
                </tbody>
            </table>
            </div>  

            <!-- Detailed Order Section -->
            <div class="bg-white rounded shadow-sm p-4 mt-5" style="font-family: 'Raleway'cursive;">
            <h2> Order Details - #123456</h2>
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
    
        



        <?php include('../includes/customer/footer.php')?>
    </body>
    </html> 

