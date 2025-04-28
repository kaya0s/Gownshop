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
                <form action="payment.php" method="post">
                    <!-- HIDDEN GOWN ID -->
                    <input type="hidden" name="gown_id" id="gown-id">
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
                        
                       <div style="width: 100%; border-top: 3px solid #041623; margin-top: 10px; font-family: 'Raleway'cursive   ;">
                       <div class="size" style="margin-top: 10px;">
                                <h6 class="title-size" >Color</h6>
                                <input style="width:fit-content" id="gown-color" class="size-input" type="text" placeholder="Golden White" disabled>
                            </div>
                       </div>

                    </div>
                    
                    <button style="background-color: #041623  !important; width: 100%; border-radius: 2px;" type="submit" class="btn btn-success" >Request an Appointment</button>
                    
                </form>
            </div>
            <!-- image container -->
            <div class="img-container">
                    <img  id="gown-image" class="img-fluid" alt="Gown Image" style=" height: auto; object-fit: cover;">
                </div>
        </div>
    </div>