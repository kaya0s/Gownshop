<!-- Drawer Overlay view gown -->
<div class="drawer-overlay" id="drawerOverlay" onclick="closeDrawer()"></div>

<!-- Drawer Panel view gown panel -->
<div class="drawer p-4" id="drawerPanel">
  <!-- Header with Gown Name and Close Button -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0 fw-bold" id="gownName"><!-- Gown Name --></h4>
    <button class="btn btn-outline-secondary" onclick="closeDrawer()">
      <i class="bi bi-x-lg"></i>
    </button>
  </div>

  <!-- Responsive row -->
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

        <!-- Submit Button -->
        <button type="submit" class="btn btn-success w-100 py-2 fw-bold" style="background-color: #041623; border-radius: 4px;">
          RENT THIS GOWN
        </button>
      </form>
    </div>

    <!-- Right Column: Gown Image -->
    <div class="col-lg-6 col-md-12 text-center">
      <img id="gown-image" class="img-fluid rounded" alt="Gown Image" style="max-height: 80vh; object-fit: cover;">
    </div>
  </div>
</div>
