// Drawer functionality
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM Content Loaded - Initializing drawer functionality');
    
    const drawerPanel = document.getElementById('drawerPanel');
    const drawerOverlay = document.getElementById('drawerOverlay');

    if (!drawerPanel || !drawerOverlay) {
        console.error('Drawer elements not found!', {
            drawerPanel: !!drawerPanel,
            drawerOverlay: !!drawerOverlay
        });
        return;
    }

    // Make openDrawer function globally available
    window.openDrawer = function(id, name, description, image, color, price, sizes) {
        console.log('Opening drawer for gown:', { id, name, price });
        
        try {
            if (!drawerPanel || !drawerOverlay) {
                console.error('Drawer elements not found when trying to open drawer!');
                return;
            }

            // Add active classes
            drawerPanel.classList.add('active');
            drawerOverlay.classList.add('active');

            // Update drawer content
            const elements = {
                'gown-id': id,
                'gownName': name,
                'description': description,
                'gown-color': color,
                'gown-image': '../uploads/gowns/' + image,
                'size-bust': sizes[0],
                'size-waist': sizes[1],
                'size-hips': sizes[2],
                'size-length': sizes[3],
                'gown-price': 'PHP ' + price,
                'review-gown-id': id
            };

            // Update each element
            for (const [id, value] of Object.entries(elements)) {
                const element = document.getElementById(id);
                if (!element) {
                    console.error(`Element with id '${id}' not found!`);
                    continue;
                }
                if (id === 'gown-image') {
                    element.src = value;
                } else if (id === 'gownName' || id === 'description') {
                    element.innerText = value;
                } else {
                    element.value = value;
                }
            }

            // Load reviews for this gown
            loadGownReviews(id);
        } catch (error) {
            console.error('Error opening drawer:', error);
        }
    };

    // Make closeDrawer function globally available
    window.closeDrawer = function() {
        console.log('Closing drawer');
        if (!drawerPanel || !drawerOverlay) {
            console.error('Drawer elements not found when trying to close drawer!');
            return;
        }
        drawerPanel.classList.remove('active');
        drawerOverlay.classList.remove('active');
    };

    // Function to load reviews
    function loadGownReviews(gownId) {
        console.log('Loading reviews for gown:', gownId);
        fetch(`./get_reviews.php?gown_id=${gownId}`)
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => {
                        throw new Error(err.error || `HTTP error! status: ${response.status}`);
                    });
                }
                return response.json();
            })
            .then(reviews => {
                const reviewsContainer = document.getElementById('reviews-container');
                if (!reviewsContainer) {
                    console.error('Reviews container not found!');
                    return;
                }
                if (reviews.length === 0) {
                    reviewsContainer.innerHTML = '<div class="col-12"><p class="text-center">No reviews yet</p></div>';
                    return;
                }
                
                let reviewsHTML = '';
                reviews.forEach(review => {
                    reviewsHTML += `
                        <div class="col-md-6 mb-4">
                            <div class="card p-3 h-100">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="fw-bold mb-0">${review.fullname}</h6>
                                    <div class="text-warning">
                                        ${generateStars(review.rating)}
                                    </div>
                                </div>
                                <p class="mb-0 small">${review.comment}</p>
                                <small class="text-muted mt-2">${formatDate(review.created_at)}</small>
                            </div>
                        </div>
                    `;
                });
                reviewsContainer.innerHTML = reviewsHTML;
            })
            .catch(error => {
                console.error('Error loading reviews:', error);
                const reviewsContainer = document.getElementById('reviews-container');
                if (reviewsContainer) {
                    reviewsContainer.innerHTML = 
                        `<div class="col-12">
                            <div class="alert alert-danger">
                                <p class="mb-0">Error loading reviews: ${error.message}</p>
                            </div>
                        </div>`;
                }
            });
    }

    // Helper function to generate star rating HTML
    function generateStars(rating) {
        let stars = '';
        for (let i = 1; i <= 5; i++) {
            if (i <= rating) {
                stars += '<i class="bi bi-star-fill"></i>';
            } else {
                stars += '<i class="bi bi-star"></i>';
            }
        }
        return stars;
    }

    // Helper function to format date
    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('en-US', { 
            year: 'numeric', 
            month: 'short', 
            day: 'numeric' 
        });
    }

    console.log('Drawer functionality initialized successfully');
}); 