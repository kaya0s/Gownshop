<?php 
//  DATABASE CONNECTION
 include('../includes/connection_db.php');
 
    // HEADER AND NAVIGATION
 require_once('../includes/customer/header.php');
        //REMOVING GOWN SESSIONS FROM COOKIE
if( isset($_SESSION['gown_name'],$_SESSION['price'],$_SESSION['gown_id'])){

    unset($_SESSION['gown_name'],$_SESSION['price'],$_SESSION['gown_id']);
}
?>  
    <!-- ALERT MESSAGE -->
    <?php require('../includes/alertmsg.php')?>
    <!-- Hero Section with Video Background -->
    <section class="hero-section">
        <!-- Due to platform limitations, a placeholder video is used. In a real implementation, replace with your actual wedding dress video -->
        <video class="video-background" autoplay loop muted playsinline>
            <source src="../assets/videos/gown.mp4" type="video/mp4">
            <!-- For demonstration purposes only, as we can't include external videos -->
        </video>
        <div class="video-overlay"></div>
        <div class="hero-content">
            <h1>ENCHANTING ELEGANCE</h1>
            <p>REDEFINING GLAMOUR, ONE GOWN AT A TIME</p>
        <a href="#gown-latest"><button class="btn btn-discover">EXPLORE OUR LATEST COLLECTION</button></a> 
        </div>
    </section>

    <!-- ALL GOWNS Section -->
    <section class="gown-section" id="gown-latest" style="scroll-margin-top:80px ;">
        
        <div class="container"  style="display:flex; width: 100%; flex-direction: column;" >
            <div class="section-title" >
                <h2>OUR LATEST GOWNS</h2>
                <p>Explore our exquisite collection of handcrafted gowns</p>
            </div>
            </div>
        <div class="container-fluid mt-5 px-4" style="margin-top: 10px !important;">
            <div class="row g-4" style="padding: 0 20px 0 20px; margin-top: -10px;">
                
        <?php
        
        $count = 0;
        
        $result=mysqli_query($conn,"Select * from gowns where available = 1 order by id desc;");
        if(mysqli_num_rows($result ) > 0){
            
        while($row = mysqli_fetch_assoc($result) ){
            $sizes = explode(',',$row['size']);
            if($count>=4){
                break;
            }
            ?>
            
            <div sty class="col-12 col-sm-6 col-md-4 col-lg-3 text-center" onclick='openDrawer(
                            <?php echo json_encode($row["id"]); ?>,
                            <?php echo json_encode($row["name"]); ?>,
                            <?php echo json_encode($row["description"]); ?>,
                            <?php echo json_encode($row["image"]); ?>,
                            <?php echo json_encode($row["color"]); ?>,
                            <?php echo json_encode($row["price"]); ?>,
                            <?php echo json_encode($sizes); ?>  
                                            )'>
                <img src="../uploads/gowns/<?php echo $row['image']; ?>" class="img-thumbnail custom-image" alt="This is the Gown Image"  style="width: 100%; height: 500px; object-fit: cover; transform: scale(1); transition: transform 0.4s;"
                    onmouseover="this.style.transform='scale(1.03)';"
                    onmouseout="this.style.transform='scale(1)';">
                <h5 class="mt-2 text-start" style="color:rgba(0, 0, 0, 0.7); font-weight: bold;" ><?php echo $row['name']; ?></h5>
            </div>

                    <?php
                     $count++;
                }
                        }else{
                            echo '<h3 class="text-center">No Gowns Found</h3>';
                        }
                       
                        ?>            
            </div>
        </div>
    </section>
    <hr>

    <!-- WEDDING GOWNS SECTION -->
    <?php require('categories/wedding-section.php');?>
    <hr>
    <!-- EVENING GOWNS SECTION -->
    <?php require('categories/evening-section.php');?>
    <hr>
    <!-- DEBUT GOWNS SECTION -->
    <?php require('categories/debut-section.php');?> 
    <hr>
    <!-- BALL GOWNS SECTION -->
    <?php require('categories/ball-section.php');?>
    <hr>
    <!-- COCKTAIL GOWNS SECTION -->
    <?php require('categories/cocktail-section.php'); ?>
    <hr>

    <!-- MODAL -->
    <?php include('selectedGownmodal.php')?>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/autoloadvideo.js" ></script>
    <script src="../assets/js/gown-drawer.js" ></script>

    <!-- FOOTER -->
    <?php include('../includes/customer/footer.php');?>
