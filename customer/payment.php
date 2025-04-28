<?php 
 session_start();
 
//  DATABASE CONNECTION
 include('../includes/connection_db.php');
 
    // HEADER AND NAVIGATION
 require_once('../includes/customer/header.php');
?>
    <div class="bg-light text-dark">
        <div class="container py-5">
            <h1 class="text-center mb-5"></h1>

             <!-- Suki Points Section -->
            <div class="alert alert-info text-center mb-5" style="font-family: 'Raleway';">
                <h5>You have <strong>120 Suki Points</strong> 💎</h5>
                <p>You can use your points to get discounts on future rentals!</p>
                <button class="btn btn-outline-primary">Use Points</button>
            </div>


            <!-- Detailed Order Section -->
            <div class="bg-white rounded shadow-sm p-4 mt-5" style="font-family: 'Raleway'cursive;">
            <h2>Order Details </h2>
            <div class="row mt-3">
                <div class="col-md-6">
                <p><strong>Order Date:</strong> April 20, 2025</p>
                <p><strong>ESTIMATED GOWN ARRIVE:</strong>TOMMORROW</p>
                <p><strong>RETURN DATE:</strong>3 DAYS AFTER RENTED / April 20, 2025</p>
                <p><strong>Payment Method:</strong> PAYPAL</p>
                </div>
                <div class="col-md-6">
                <p><strong>Shipping To:</strong><br>Jane Doe<br>123 Bridal Ave<br>Los Angeles, CA</p>
                </div>
            </div>

            <h5 class="mt-4">Items Ordered</h5>
            <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item d-flex justify-content-between">
                </li>
                <li class="list-group-item d-flex justify-content-between">
                <span>Silk Mermaid Gown x1</span>
                <span>$400.00</span>
                </li>
            </ul>
            <div class="text-end mb-3">
                <strong>Total: $899.00</strong>
            </div>

            <div class="d-flex justify-content-end gap-">
                <!-- PayPal button container -->
                <div id="paypal-button-container"></div>
            </div>
            </div>
        </div>
  
    </div>   
    
    <!-- FOOTER -->
    <?php
    include('../includes/customer/footer.php');
    ?>
    
    <!-- BOOTSTRAP -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- PayPal SDK -->
<script src="https://www.paypal.com/sdk/js?client-id=AQPRUGHYzhVZLSyPxDrChkh_Q9JH5j_asBVjKg13bLDsO4b4QIbB1f8gsZKw0PRfIs_ICB6AggeZ0dd8&currency=PHP"></script>

<!-- PAYPAL -->
<script src="../assets/js/paypal.js" ></script>

