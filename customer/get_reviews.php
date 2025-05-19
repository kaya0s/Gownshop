<?php
// Set JSON header at the very beginning
header('Content-Type: application/json');

// Prevent any output before JSON response
ob_start();

include('../includes/connection_db.php');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Get gown_id from query parameter
$gown_id = isset($_GET['gown_id']) ? intval($_GET['gown_id']) : 0;

if ($gown_id <= 0) {
    echo json_encode(['error' => 'Invalid gown ID']);
    exit;
}

try {
    // Query to get reviews for the specific gown
    $query = "SELECT r.*, u.email as fullname 
              FROM gown_reviews r 
              JOIN users u ON r.user_email = u.email 
              WHERE r.gown_id = ? 
              ORDER BY r.created_at DESC";
    $stmt = mysqli_prepare($conn, $query);                          

    if (!$stmt) {
        throw new Exception("Failed to prepare statement: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "i", $gown_id);
    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("Failed to execute statement: " . mysqli_stmt_error($stmt));
    }

    $result = mysqli_stmt_get_result($stmt);
    if (!$result) {
        throw new Exception("Failed to get result: " . mysqli_error($conn));
    }

    $reviews = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $reviews[] = [  
            'id' => $row['id'],
            'rating' => $row['star'], // Changed from 'rating' to 'star' to match the table column
            'comment' => $row['comment'],
            'fullname' => $row['fullname'],
            'created_at' => $row['created_at']
        ];
    }

    // Clear any output buffer
    ob_clean();
    
    // Return reviews as JSON
    echo json_encode($reviews);

} catch (Exception $e) {
    // Clear any output buffer
    ob_clean();
    
    http_response_code(500);
    echo json_encode([
        'error' => $e->getMessage(),
        'details' => [
            'gown_id' => $gown_id,
            'sql_error' => mysqli_error($conn)
        ]
    ]);
} finally {
    if (isset($stmt)) {
        mysqli_stmt_close($stmt);
    }
    // End output buffering
    ob_end_flush();
}
?> 