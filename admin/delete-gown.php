<?php
require_once '../includes/connection_db.php'; // Include your database connection

// Get and validate ID
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    http_response_code(400);
    die(json_encode(['success' => false, 'message' => 'Invalid gown ID']));
}

try {
    // DELETE GOWN REVIEWS  FOR THIS GOWN DELETE SELECTED
    mysqli_query($conn, "DELETE FROM gown_reviews WHERE gown_id = $id");
    // First get the image filename
    $imageFilename = '';
    $query = "SELECT image FROM gowns WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $imageFilename);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Then delete the record
    $query = "DELETE FROM gowns WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    $success = mysqli_stmt_execute($stmt);
    $affectedRows = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);

    if ($success && $affectedRows > 0) {
        // Delete the image file if it exists
        if ($imageFilename) {
            $imagePath = '../uploads/gowns/' . $imageFilename;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $_SESSION['successmsg'] = "Gown deleted successfully!";
        echo json_encode(['success' => true, 'message' => 'Gown deleted successfully']);
    } else {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Gown not found or already deleted']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>