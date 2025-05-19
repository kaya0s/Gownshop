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
            <!-- CUSTOMIZE SIZE -->
            <p><strong>CUSTOMIZE SIZE </strong></p>
            <div class="col-6 mb-3">
              <label for="size-bust" class="fw-bold">Bust</label>
              <input class="form-control form-control-lg" name="size-bust" id="size-bust" min="0" type="number" required >
            </div>
            <div class="col-6 mb-3">
              <label for="size-waist" class="fw-bold">Waist</label>
              <input class="form-control form-control-lg" name="size-waist" id="size-waist" type="number" min="0" required  >
            </div>
            <div class="col-6 mb-3">
              <label for="size-hips" class="fw-bold">Hips</label>
              <input class="form-control form-control-lg" name="size-hips" id="size-hips" type="number"  min="0" required  >
            </div>
            <div class="col-6 mb-3">
              <label for="size-length" class="fw-bold">Length</label>
              <input class="form-control form-control-lg" name="size-length" id="size-length" type="number" min="0" required  >
            </div>
          </div>

          <hr>

          <!-- Color & Price --> 
          <div class="mb-3 text-start">
            <label for="gown-color" class="fw-bold">Color</label>
            <input class="form-control form-control-lg mb-3" id="gown-color" type="text" disabled >

            <label for="gown-price" class="fw-bold">Price</label>
            <input class="form-control form-control-lg" id="gown-price" type="text" disabled >
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
              <a href="../index.php" class="btn btn-primary px-4 py-2" style="flex: 1; border-radius: 1px;">Login</a>
              <a href="../auth/register.php" class="btn btn-secondary px-4 py-2" style="flex: 1;border-radius: 1px;">Sign Up</a>
            </div>
          <?php endif; ?>
        </form>
      </div>
      
      <div class="col-lg-6 col-md-12 text-center">
        <img id="gown-image" class="img-fluid rounded" alt="Gown Image" style="max-height: 80vh; object-fit: cover;">
      </div>
    </div>
    
    <!-- Gown Reviews Section -->
    <div class="mt-5">
      <h5 class="fw-bold border-bottom pb-2 mb-4">Customer Reviews</h5>
      
      <!-- Add Review Form - Only visible to logged in users -->
      <?php if(isset($_SESSION['fullname'])): ?>
        <div class="card mb-4 p-3 bg-light">
          <form action="submit_review.php" method="post">
            <input type="hidden" name="gown_id" id="review-gown-id">
            
            <h6 class="fw-bold mb-3">Write Your Review</h6>
            
            <!-- Star Rating -->
            <div class="mb-3">
              <label class="form-label">Rating</label>
              <div class="star-rating">
                <input type="radio" id="star5" name="rating" value="5" required /><label for="star5"></label>
                <input type="radio" id="star4" name="rating" value="4" /><label for="star4"></label>
                <input type="radio" id="star3" name="rating" value="3" /><label for="star3"></label>
                <input type="radio" id="star2" name="rating" value="2" /><label for="star2"></label>
                <input type="radio" id="star1" name="rating" value="1" /><label for="star1"></label>
              </div>
            </div>
            
            <!-- Review Comment -->
            <div class="mb-3">
              <label for="reviewComment" class="form-label">Your Review</label>
              <textarea class="form-control" id="reviewComment" name="comment" rows="3" required placeholder="Share your experience with this gown..."></textarea>
            </div>
            
            <!-- Submit Button -->
            <div class="text-end">
              <button type="submit" class="btn btn-primary" style="background-color: #041623;">Submit Review</button>
            </div>
          </form>
        </div>
      <?php endif; ?>
      
      <!-- Reviews Container -->
      <div class="row" id="reviews-container">  
        <!-- Reviews will be loaded here via JavaScript -->
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
    right: -60%;
    width: 60%;
    height: 100%;
    background-color: white;
    z-index: 1000;
    overflow-y: auto;
    transition: right 0.3s ease-in-out;
  }
  
  .drawer.active {
    right: 0;
  }
  
  /* Styles for the reviews section */
  .text-warning .bi-star-fill,
  .text-warning .bi-star-half,
  .text-warning .bi-star {
    color: #ffc107;
  }
  
  #gownReviews .card {
    border-radius: 8px;
    transition: transform 0.3s;
    border: 1px solid rgba(0,0,0,0.1);
  }
  
  #gownReviews .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
  }
  
  /* Star rating input styles */
  .star-rating {
    direction: rtl;
    display: inline-block;
    padding: 0;
  }
  
  .star-rating input {
    display: none;
  }
  
  .star-rating label {
    color: #ddd;
    font-size: 1.5rem;
    padding: 0 0.1em;
    cursor: pointer;
  }
  
  .star-rating label:before {
    content: '\2605';
  }
  
  .star-rating input:checked ~ label {
    color: #ffc107;
  }
  
  .star-rating label:hover,
  .star-rating label:hover ~ label {
    color: #ffc107;
  }
  
  #reviewForm .form-control:focus {
    border-color: #041623;
    box-shadow: 0 0 0 0.25rem rgba(4, 22, 35, 0.25);
  }
</style>