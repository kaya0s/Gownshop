<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['update-gown'])) {
    include '../includes/connection_db.php';

    $gown_id = $_POST['gown_id'];
    $category_ID = $_POST['category'];
    $name = $_POST['name'];
    $color = $_POST['gown-color'];
    $price = $_POST['price'];
    $status = $_POST['gown-status'];

    // Combine size inputs
    $bust = $_POST['bust'];
    $waist = $_POST['waist'];
    $hips = $_POST['hips'];
    $length = $_POST['length'];
    $sizeString = "$bust,$waist,$hips,$length";



    // Fetch the existing image filename
    $query = "SELECT image FROM gowns WHERE id = '$gown_id'";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $existingImage = $row['image'];

        // Delete the existing image file
        $existingImagePath = '../uploads/gowns/' . $existingImage;
        if (file_exists($existingImagePath)) {
            unlink($existingImagePath);
        }
    }

    // Handle new image upload
    $image = $_FILES['image'];
    $filename = uniqid('gown_') . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);
    $uploadPath = '../uploads/gowns/' . $filename;

    // Create directory if not exists
    if (!file_exists('../uploads/gowns')) {
        mkdir('../uploads/gowns', 0777, true);
    }

    if($status == "unavailable"){
        $sql = "UPDATE gowns 
        SET name = '$name', color = '$color', size = '$sizeString', price = '$price', image = '$filename', category_id = '$category_ID', available = NULL 
        WHERE id = '$gown_id'";
    }else{
        $sql = "UPDATE gowns 
        SET name = '$name', color = '$color', size = '$sizeString', price = '$price', image = '$filename', category_id = '$category_ID',available = NULL 
        WHERE id = '$gown_id'";
    }


    if (move_uploaded_file($image['tmp_name'], $uploadPath)) {

        if (mysqli_query($conn, $sql)) {
            $_SESSION['successmsg'] = "Gown updated successfully!";
        } else {
            $_SESSION['errormsg'] = "Database error: " . mysqli_error($conn);
        }
    } else {
        $_SESSION['errormsg'] = "Failed to upload new image.";
    }

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}
?>
                
<!-- Update Gown Modal -->
<div class="modal fade" id="updateGownModal" tabindex="-1" aria-labelledby="updateGownLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="update-gown.php" enctype="multipart/form-data" class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Update Gown #<span id="textGownId"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Hidden input for gown ID -->
                <input type="hidden" name="gown_id" id="GownId">
                <!-- Display error/success messages -->
                <?php if (isset($_SESSION['errormsg'])): ?>
                    <div class="alert alert-danger"><?= $_SESSION['errormsg'] ?></div>
                    <?php unset($_SESSION['errormsg']); ?>
                <?php endif; ?>
                <?php if (isset($_SESSION['successmsg'])): ?>
                    <div class="alert alert-success"><?= $_SESSION['successmsg'] ?></div>
                    <?php unset($_SESSION['successmsg']); ?>
                <?php endif; ?>
                <!-- Gown Category -->  
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-select" name="category" id="category" required>
                        <option value="" disabled selected>Select category</option>
                        <option value="1">Evening Gown</option>
                        <option value="2">Wedding Gown</option>
                        <option value="3">Debut Gown</option>
                        <option value="4">Ball Gown</option>
                        <option value="5">Cocktail Dress</option>
                    </select>
                </div>

                <!-- Gown Name -->
                <div class="mb-3">
                    <label class="form-label">Gown Name</label>
                    <input type="text" name="name" class="form-control" required maxlength="100">
                </div>
        
                <!-- Gown Color -->
                <div class="mb-3">
                    <label for="gown-color" class="form-label">Color</label>
                    <select class="form-select" id="gown-color" name="gown-color" required>
                        <option value="" disabled selected>Select a color</option>
                        <option value="red">Red</option>
                        <option value="blue">Blue</option>
                        <option value="gold">Gold</option>
                        <option value="black">Black</option>
                        <option value="white">White</option>
                    </select>
                </div>

                <!-- Gown Size -->
                <div class="mb-3">
                    <label class="form-label">Size (inch)</label>
                    <div class="row">
                        <div class="col-md-3">
                            <input type="number" step="0.1" name="bust" class="form-control" placeholder="Bust" min="0" required>
                        </div>
                        <div class="col-md-3">
                            <input type="number" step="0.1" name="waist" class="form-control" placeholder="Waist" min="0" required>
                        </div>
                        <div class="col-md-3">
                            <input type="number" step="0.1" name="hips" class="form-control" placeholder="Hips" min="0" required>
                        </div>
                        <div class="col-md-3">
                            <input type="number" step="0.1" name="length" class="form-control" placeholder="Length" min="0" required>
                        </div>
                    </div>
                </div>
                
                <!-- Price -->
                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <div class="input-group">
                        <span class="input-group-text">₱</span>
                        <input type="number" name="price" class="form-control" step="0.01" min="0" required>
                    </div>
                </div>
                
                <!-- Gown Status -->
                <div class="mb-3">
                    <label for="gown-status" class="form-label">Status</label>
                    <select class="form-select" id="gown-status" name="gown-status" required>
                        <option value="" disabled selected>Select status</option>
                        <option value="available">Available</option>
                        <option value="unavailable">Unavailable</option>
                    </select>
                </div>

                <!-- Image -->
                <div class="mb-3">
                    <label class="form-label">Upload Image</label>
                    <input type="file" name="image" class="form-control" accept="image/jpeg,image/png,image/gif,image/webp" required>
                    <small class="text-muted">Max size: 2MB (JPEG, PNG, GIF, WebP)</small>
                </div>


            </div>
            <div class="modal-footer">
                <button type="submit" name="update-gown" class="btn btn-success">Save Gown</button>
            </div>
        </form>
    </div>
</div>