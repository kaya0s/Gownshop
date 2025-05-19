<?php
// Start session and include database connection
session_start();
include('../includes/connection_db.php');

// Set header to return JSON
header('Content-Type: application/json');

// Get search query from GET parameter
$query = isset($_GET['query']) ? trim($_GET['query']) : '';

if (empty($query)) {
    echo json_encode([]);
    exit;
}

// Prepare the search query
$searchQuery = "%" . mysqli_real_escape_string($conn, $query) . "%";

// Search in gowns table
$sql = "SELECT id, name, description, image, color, price, size 
        FROM gowns 
        WHERE available = 1 
        AND (name LIKE ? OR description LIKE ?)
        ORDER BY name ASC
        LIMIT 10";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $searchQuery, $searchQuery);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$gowns = [];
while ($row = mysqli_fetch_assoc($result)) {
    // Convert size string to array
    $sizes = explode(',', $row['size']);
    
    // Add gown to results
    $gowns[] = [
        'id' => $row['id'],
        'name' => $row['name'],
        'description' => $row['description'],
        'image' => $row['image'],
        'color' => $row['color'],
        'price' => $row['price'],
        'sizes' => $sizes
    ];
}

// Return results as JSON
echo json_encode($gowns);

// Close statement and connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?> 