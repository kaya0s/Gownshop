<?php
require_once 'config/database.php';

// Verify CSRF token
session_start();
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    echo json_encode(['success' => false, 'message' => 'Invalid CSRF token']);
    exit;
}

// Check if we have the required fields
if (!isset($_POST['transaction_id']) || !isset($_POST['date_rented'])) {
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit;
}

// Sanitize inputs
$transactionId = mysqli_real_escape_string($conn, $_POST['transaction_id']);
$dateRented = mysqli_real_escape_string($conn, $_POST['date_rented']);

// Update transaction in database - change status to rented and set date_rented
$sql = "UPDATE transactions 
        SET status = 'rented',
            date_rented = '$dateRented',
            updated_at = NOW()
        WHERE id = '$transactionId' AND status = 'pending'";

if (mysqli_query($conn, $sql)) {
    if (mysqli_affected_rows($conn) > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No pending transaction found with that ID']);
    }
} else {
    echo json_encode(['success' => false, 'message' => mysqli_error($conn)]);
}

mysqli_close($conn);
?>