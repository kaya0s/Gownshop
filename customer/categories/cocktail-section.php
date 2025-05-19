<!-- COCKTAIL GOWN SECTION -->
<section class="gown-section" id="gown-cocktail" style="scroll-margin-top: 80px;">
            
    <div class="container"  style="display:flex; width: 100%; flex-direction: column;" >
        <div class="section-title" >
            <h2>COCKTAIL GOWNS</h2>
            <p>Explore our exquisite collection of handcrafted cocktail gowns</p>
        </div>
        </div>
    <div class="container-fluid mt-5 px-4" style="margin-top: 10px !important;">
        <div class="row g-4" style="padding: 0 20px 0 20px; margin-top: -10px;">
        
                <?php
                $result=mysqli_query($conn,"Select * from gowns where category_id = 5 AND  available  = 1 order by id desc;");
                if(mysqli_num_rows($result ) > 0){
                    
        while($row = mysqli_fetch_assoc($result)){
            $sizes = explode(',',$row['size']);
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
        }
                }else{
                    echo '<h4 class="text-center">No Cocktail Gowns Found.</h4>';
                }
                ?>   

    </div>
</div></section>