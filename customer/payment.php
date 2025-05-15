<?php 
//  DATABASE CONNECTION 
 include('../includes/connection_db.php');
 require_once('../includes/customer/header.php');

    // if user not logged cant access this page
    if(!isset($_SESSION['fullname'])){
        header("location: homepage.php");
        exit();
    }

    if($_SERVER['REQUEST_METHOD'] ==="POST"){
     $_SESSION['gown_id'] = $_POST['gown_id'];
    }   
    
    //cant acccess this page if gown not set
    if(!isset($_SESSION['gown_id'])){
        header("location:homepage.php");
        exit();

    }
    $result = mysqli_query($conn,"SELECT * FROM GOWNS WHERE ID = ".$_SESSION['gown_id']." ");
    $gown=mysqli_fetch_assoc($result);

    
     $_SESSION['price']=$gown['price'];

    // HEADER AND NAVIGATION
 
 include('../includes/alertmsg.php');
?>
    <div class="bg-light text-dark">
        <div class="container py-5">
            <h1 class="text-center mb-5"></h1>

            <!-- Detailed Order Section -->
            <div class="bg-white rounded shadow-sm p-4 " style="font-family: 'Raleway'cursive;">
            <h2>Order Details </h2>
            <div style="justify-content:space-between " class="row mt-3">
                <div  class="col-md-4">
                    <img style="width:70%" src="../uploads/gowns/<?php echo $gown['image'];?>" alt="">
                </div>
                <div class="col-md-5">


                    <p><strong>Shipping To: </strong><?php echo $_SESSION['fullname']; ?><br><strong>ADDRESS:</strong> <?php echo $_SESSION['address'] ?></p>
                    <br>
                    <p><strong>RETURN DATE:</strong>5 DAYS AFTER ADMIN APPROVAL</p>
                    <p><strong>SHOP LOCATION:</strong> pay over the counter / direct rent</p>
                    
                    <!-- MAP FRAME -->
                        <iframe  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1974.9947514410844!2d125.12801621478226!3d8.102550045120761!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32ff01c35c7fae59%3A0x9b3fbb15fcd96554!2sHJ%20Wedding%20%26%20Events%20Gownshop!5e0!3m2!1sen!2sph!4v1747205876161!5m2!1sen!2sph" width="400" height="260" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    
                </div>
                <div class="col-md-3">
                <div style="flex-direction: column;" class="d-flex  justify-content-end gap-">
                    <!-- PayPal button container -->

                    <!-- USE SUKI Points Section -->
                    <div class="alert alert-info text-center mb-5" style="font-family: 'Raleway';">
                        <form action="points.php" method="post" onsubmit="return confirmUsePoints()">
                            <h5>You have <strong style="font-size: 30px;"><?php echo $_SESSION['suki_points']; ?></strong> Suki Points 💎</h5>
                            <p><strong style="font-size: 25px;">1000</strong> points = Free 1 Gown Rent</p>
                            <button type="submit" class="btn btn-outline-primary">Use Points</button>
                        </form>
                    </div>
                    <div id="paypal-button-container"></div>
                    <p class="text-center" >or</p>

                    <!-- COUNTER PAYMENT BUTTON -->
                    <form action="counterPayment.php" method="post" onsubmit="return confirmCounterPayment()">
                        <button style="border-radius: 0px;width:100%;" name="counterPayment" type="submit" class="btn btn-outline-primary">
                            PAY OVER THE COUNTER
                        </button>
                    </form>
                    
                    
                </div>
            </div>

            <h5 class="mt-4">Gown Rent:</h5>
            <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item d-flex justify-content-between">
                </li>
                <li class="list-group-item d-flex justify-content-between">
                <span><h3><?php echo $gown['name'] ?></h3></span>
                <span><h3><strong>Total: ₱<?php echo $gown['price']; 

                $_SESSION['gown_name'] = $gown['name'];
                $_SESSION['price'] = $gown['price'];
                ?></strong></h3></span>
            
                </li>
            </ul>
            <div class="text-end mb-3">    
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
<script>
paypal.Buttons({
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: "<?php echo htmlspecialchars($gown['price'], ENT_QUOTES, 'UTF-8'); ?>"
                }
            }]
        });
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            // Redirect to payment-process.php with order info as GET parameters

            <?php $_SESSION['successmsg'] ="PAYMENT SUCCESSFULLY YOUR BOOKING WILL BE PENDING. \n ADDED 50 SUKI POINTS ADDED";?>
            window.location.href = "../includes/customer/payment-process.php";
        });
    }
}).render('#paypal-button-container');
</script>

<!-- PAYMENT BUTTON SCRIPTS -->
<script>
    
    function confirmUsePoints() {
        return confirm("Are you sure you want to use your Suki Points?");
    }

     function confirmCounterPayment() {
        return confirm("Are you sure you want to proceed with counter payment?");
    }
</script>


