<?php
// Start the session to access session variables
session_start();

// Database connection
require_once '../includes/connection_db.php';

// Check if user is logged in
if (!isset($_SESSION['fullname']) || !isset($_SESSION['email'])) {
    // Not logged in, redirect to landing page
    header("Location: homepage.php");
    exit();
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs
    $gown_id = $_POST['gown_id'];
    $fullname = $_SESSION['fullname']; // Get fullname from session
    $rating = $_POST['rating']? filter_var($_POST['rating'], FILTER_SANITIZE_NUMBER_INT) : 0;
    $comment = $_POST['comment'] ;
    
    // Additional validation
    if (empty($gown_id) || $gown_id <= 0) {
        $_SESSION['errormsg'] = "Invalid gown selection.";
        header("Location: homepage.php");
        exit();
    }
    
    if ($rating < 1 || $rating > 5) {
        $_SESSION['errormsg'] = "Please provide a valid rating (1-5 stars).";
        header("Location: homepage.php");
        exit();
    }
    
    if (empty($comment)) {
        $_SESSION['errormsg'] = "Please provide a review comment.";
        header("Location: homepage.php");
        exit();
    }
    
    // Check if user has already reviewed this gown
    $stmt = $conn->prepare("SELECT id FROM gown_reviews WHERE gown_id = ? AND user_email = ?");
    $stmt->bind_param("is", $gown_id, $_SESSION['email']);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // User has already reviewed this gown, update the existing review
        $review = $result->fetch_assoc();
        $review_id = $review['id'];
        
        $stmt = $conn->prepare("UPDATE gown_reviews SET star = ?, comment = ? WHERE id = ?");
        $stmt->bind_param("isi", $rating, $comment, $review_id);
        
        if ($stmt->execute()) {
            $_SESSION['successmsg'] = "Your review has been updated successfully.";
        } else {
            $_SESSION['errormsg'] = "Error updating your review. Please try again. " . $conn->error;
        }
    } else {
        // Insert new review
        $stmt = $conn->prepare("INSERT INTO gown_reviews (gown_id, user_email, star, comment) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $gown_id, $_SESSION['email'], $rating, $comment);
        
        if ($stmt->execute()) {
            $_SESSION['successmsg'] = "Thank you for your review!";
        } else {
            $_SESSION['errormsg'] = "Error submitting your review. Please try again. " . $conn->error;
        }
    }
    
    // Redirect back to previous page or gown details page
    if (isset($_SERVER['HTTP_REFERER'])) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    } else {
        header("Location: homepage.php");
    }
    exit();
}
?>