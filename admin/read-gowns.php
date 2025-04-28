<?php include('update-gown.php')  ?>
<?php require_once('../includes/alertmsg.php');?>


<div class="table-responsive">
    <table class="table table-bordered table-striped text-center">
        <thead class="table-light">
            <tr>
                <th>Image</th>
                <th>Gown ID</th>
                <th>Name</th>
                <th>Size</th>
                <th>Color</th>      
                <th>Category</th>
                <th>Price</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="table-body">
            <!-- Table content will load automatically -->
        </tbody>
    </table>
</div>

<?php
// Fetch gowns from the database
$query = "SELECT g.*, c.name as category_name FROM gowns g LEFT JOIN categories c ON g.category_id = c.id ORDER BY g.id DESC";
$result = mysqli_query($conn, $query);
$gownData = [];
if(mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $gownData[] = [
            'id' => $row['id'],
            'image' => $row['image'], // This should be just the filename (e.g., "gown1.jpg")
            'name' => $row['name'],
            'size' => $row['size'],
            'color' => $row['color'],
            'category' => $row['category_name'],
            'price' => $row['price'],
            'available' => $row['available'],
            'created_at' => date('M d, Y', strtotime($row['created_at']))
        ];
    // Store the last gown ID for the update button
    }
}
?>

<script>
// Convert PHP array to JavaScript object
const allGownData = <?php echo json_encode($gownData); ?>;

// Function to update button active states
function updateButtonStates(activeBtnId) {
    document.querySelectorAll('#all-gowns-btn, #available-btn, #unavailable-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    document.getElementById(activeBtnId).classList.add('active');
}

function filterGowns(status) {
    // Filter data based on status
    let filteredData = allGownData;
    if (status === 'available') {
        filteredData = allGownData.filter(gown => gown.available);
        updateButtonStates('available-btn');
    } else if (status === 'unavailable') {
        filteredData = allGownData.filter(gown => !gown.available);
        updateButtonStates('unavailable-btn');
    } else {
        updateButtonStates('all-gowns-btn');
    }
    
    renderGownTable(filteredData);
}

function renderGownTable(data) {
    const tbody = document.getElementById('table-body');
    tbody.innerHTML = ''; // Clear table
    
    if (data.length === 0) {
        tbody.innerHTML = `<tr><td colspan="10" class="text-center">No gowns found</td></tr>`;
        return;
    }
    
    data.forEach((gown) => {
        // Image path - adjust if your uploads folder is in a different location
        const imagePath = `../uploads/gowns/${gown.image}`;
        
        // Image cell with modal trigger for larger view
        const imageCell = gown.image 
            ? `<a href="#" onclick="viewImage('${imagePath}', '${gown.name}')">
                 <img src="${imagePath}" alt="${gown.name}" class="img-thumbnail" style="max-width: 80px; max-height: 80px;">
               </a>`
            : '<span class="text-muted">No Image</span>';
        
        // Format the price
        const formattedPrice = gown.price ? `₱${parseFloat(gown.price).toFixed(2)}` : 'N/A';
        
        // Format availability
        const availability = gown.available ? 
            '<span class="badge bg-success">Available</span>' : 
            '<span class="badge bg-danger">Unavailable</span>';
        
        // Action buttons
        const actions = `
            <div class="btn-group" role="group">
                <button type="button"
                        class="btn btn-sm btn-outline-primary"
                        onclick="openUpdateModal(${gown.id})"
                        data-bs-toggle="modal" data-bs-target="#updateGownModal">
                    <i class="bi bi-pencil-square"></i> update
                </button>

                <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete(${gown.id})">
                    <i class="bi bi-trash"></i> Delete
                </button>
            </div>
        `;
        
        tbody.innerHTML += `
            <tr>
                <td>${imageCell}</td>
                <td>${gown.id}</td>
                <td>${gown.name}</td>
                <td>${gown.size}</td>
                <td>${gown.color}</td>
                <td>${gown.category}</td>
                <td>${formattedPrice}</td>
                <td>${availability}</td>
                <td>${gown.created_at}</td>
                <td>${actions}</td>
            </tr>
        `;
    });
}


// Function to view larger image in modal
function viewImage(imagePath, title) {
    // Create modal HTML
    const modalHTML = `
        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel">${title}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="${imagePath}" style="max-height:60vh" class="img-fluid" alt="${title}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    // Add modal to body
    document.body.insertAdjacentHTML('beforeend', modalHTML);
    
    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('imageModal'));
    modal.show();
    
    // Remove modal when closed
    document.getElementById('imageModal').addEventListener('hidden.bs.modal', function() {
        this.remove();
    });
}

function openUpdateModal(gownId) {
    // Find the gown in your JS array
    const gown = allGownData.find(g => g.id == gownId);
    if (!gown) return;

    // Fill modal fields
    document.getElementById('GownId').value = gown.id;
    document.getElementById('textGownId').textContent = gown.id;
    document.getElementById('updateGownName').value = gown.name;
    
}


function confirmDelete(id) {
    if (confirm('Are you sure you want to delete this gown?')) {
        fetch(`delete-gown.php?id=${id}`, {
            method: 'DELETE'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Gown deleted successfully');
                // Refresh the table
                filterGowns(document.querySelector('.btn.active').id.replace('-btn', ''));
                window.location.reload();   
            } else {
                alert('Error deleting gown: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error deleting gown');
        });
    }
}

// Load all gowns immediately when page loads
document.addEventListener('DOMContentLoaded', function() {
    renderGownTable(allGownData);
});

// Make sure Bootstrap JS is loaded for the modal
if (typeof bootstrap === 'undefined') {
    console.warn('Bootstrap JS not loaded - image modal will not work');
}
</script>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">

<!-- Bootstrap JS (required for modal) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>