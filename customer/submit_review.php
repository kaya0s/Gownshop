<?php
// Start the session to access session variables
session_start();

// Database connection
require_once '../includes/connection_db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['errormsg'] = "Please login to submit a review";
    header("Location: homepage.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gown_id = isset($_POST['gown_id']) ? intval($_POST['gown_id']) : 0;
    $rating = isset($_POST['rating']) ? intval($_POST['rating']) : 0;
    $comment = isset($_POST['comment']) ? trim($_POST['comment']) : '';
    $user_email = $_SESSION['email'];

    // Validate inputs
    if ($gown_id <= 0 || $rating < 1 || $rating > 5 || empty($comment)) {
        $_SESSION['errormsg'] = "Invalid review data";
        header("Location: homepage.php");
        exit();
    }

    // Check if user has already reviewed this gown
    $check_query = "SELECT * FROM gown_reviews WHERE gown_id = ? AND user_email = ?";
    $check_stmt = mysqli_prepare($conn, $check_query);
    mysqli_stmt_bind_param($check_stmt, "is", $gown_id, $user_email);
    mysqli_stmt_execute($check_stmt);
    $result = mysqli_stmt_get_result($check_stmt);

    if (mysqli_num_rows($result) > 0) {
        // Update existing review
        $update_query = "UPDATE gown_reviews SET star = ?, comment = ? WHERE gown_id = ? AND user_email = ?";
        $update_stmt = mysqli_prepare($conn, $update_query);
        mysqli_stmt_bind_param($update_stmt, "isis", $rating, $comment, $gown_id, $user_email);
        
        if (mysqli_stmt_execute($update_stmt)) {
            $_SESSION['successmsg'] = "Review updated successfully!";
        } else {
            $_SESSION['errormsg'] = "Error updating review: " . mysqli_error($conn);
        }
        
        mysqli_stmt_close($update_stmt);
    } else {
        // Insert new review
        $query = "INSERT INTO gown_reviews (gown_id, user_email, star, comment) 
                  VALUES (?, ?, ?, ?)";
        
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "isis", $gown_id, $user_email, $rating, $comment);
        
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['successmsg'] = "Review submitted successfully!";
        } else {
            $_SESSION['errormsg'] = "Error submitting review: " . mysqli_error($conn);
        }
        
        mysqli_stmt_close($stmt);
    }
    
    mysqli_stmt_close($check_stmt);
}

header("Location: homepage.php");
exit();
?>