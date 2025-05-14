<!-- Drawer Overlay view gown with blur effect -->
<div class="drawer-overlay" id="drawerOverlay" onclick="closeDrawer()" style="backdrop-filter: blur(5px);"></div>

<!-- Drawer Panel view gown panel -->
<div class="drawer p-4" id="drawerPanel">
  <!-- Header with Gown Name and Close Button -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0 fw-bold" id="gownName"><!-- Gown Name --></h4>
    <button class="btn btn-outline-secondary" onclick="closeDrawer()">
      <i class="bi bi-x-lg"></i>
    </button>
  </div>

  <!-- Responsive row - visible to all users -->
  <div class="row g-4 text-center justify-content-center align-items-center">
    
    <!-- Left Column: Description and Details -->
    <div class="col-lg-6 col-md-12">
      <form action="payment.php" method="post">
        <input type="hidden" name="gown_id" id="gown-id">

        <!-- Description -->
        <div class="description-box mb-4">
          <p id="description" class="mb-0 text-center"><!-- Gown Description Here --></p>
        </div>

        <!-- Sizes -->
        <div class="row text-start mb-3">
          <div class="col-6 mb-3">
            <label for="size-bust" class="fw-bold">Bust</label>
            <input class="form-control form-control-lg" id="size-bust" type="text" disabled>
          </div>
          <div class="col-6 mb-3">
            <label for="size-waist" class="fw-bold">Waist</label>
            <input class="form-control form-control-lg" id="size-waist" type="text" disabled>
          </div>
          <div class="col-6 mb-3">
            <label for="size-hips" class="fw-bold">Hips</label>
            <input class="form-control form-control-lg" id="size-hips" type="text" disabled>
          </div>
          <div class="col-6 mb-3">
            <label for="size-length" class="fw-bold">Length</label>
            <input class="form-control form-control-lg" id="size-length" type="text" disabled>
          </div>
        </div>

        <hr>

        <!-- Color & Price --> 
        <div class="mb-3 text-start">
          <label for="gown-color" class="fw-bold">Color</label>
          <input class="form-control form-control-lg mb-3" id="gown-color" type="text" disabled>

          <label for="gown-price" class="fw-bold">Price</label>
          <input class="form-control form-control-lg" id="gown-price" type="text" disabled>
        </div>

        <hr>

        <!-- Different buttons based on login status -->
        <?php if(isset($_SESSION['fullname'])): ?>
          <!-- Submit Button for logged in users -->
          <button type="submit" class="btn btn-success w-100 py-2 fw-bold" style="background-color: #041623; border-radius: 4px;">
            RENT THIS GOWN
          </button>
        <?php else: ?>
          <!-- Login/Signup buttons for non-logged in users -->
          <div style="border-radius: 1px;" class="alert alert-info mb-3" role="alert">
            <small>Please login or sign up to rent this gown</small>
          </div>
          <div class="d-flex gap-2 justify-content-center">
            <a href="login.php" class="btn btn-primary px-4 py-2" style="flex: 1; border-radius: 1px;">Login</a>
            <a href="signup.php" class="btn btn-secondary px-4 py-2" style="flex: 1;border-radius: 1px;">Sign Up</a>
          </div>
        <?php endif; ?>
      </form>
    </div>
    
    <div class="col-lg-6 col-md-12 text-center">
      <img id="gown-image" class="img-fluid rounded" alt="Gown Image" style="max-height: 80vh; object-fit: cover;">
    </div>
  </div>
</div>

<!-- Add this CSS to your stylesheet -->
<style>
  .drawer-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 999;
    backdrop-filter: blur(5px);
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s, visibility 0.3s;
  }
  
  .drawer-overlay.active {
    opacity: 1;
    visibility: visible;
  }
  
  .drawer {
    position: fixed;
    top: 0;
    right: -100%;
    width: 95%;
    max-width: 1000px;
    height: 100%;
    background-color: white;
    z-index: 1000;
    overflow-y: auto;
    transition: right 0.3s ease-in-out;
  }
  
  .drawer.active {
    right: 0;
  }
</style>