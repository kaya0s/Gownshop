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
                    <?php if($row['status']=== "pending"){?>
                     <span class="badge bg-warning"><?php echo $row['status']; ?></span>
                    <?php }elseif($row['status']=== "rented"){ ?>
                        <span class="badge bg-info"><?php echo $row['status']; ?></span>
                    <?php }elseif($row['status']=== "returned"){ ?>
                        <span class="badge bg-success"><?php echo $row['status']; ?></span>
                    <?php } elseif($row['status']=== "unreturned"){ ?>
                        <span class="badge bg-danger"><?php echo $row['status']; ?></span>
                    <?php } else {
                        echo "unknown status";
                    }?>
                </td>
                </tr>
                <?php }?>
                <!-- More rows here -->
                </tbody>
            </table>
            </div>  

            <!-- Detailed Order Section -->
            
        </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</div>   
    
        



        <?php include('../includes/customer/footer.php')?>
    </body>
    </html> 

