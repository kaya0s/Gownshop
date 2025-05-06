<?php
require_once 'config/database.php';

// Verify CSRF token
session_start();
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    echo json_encode(['success' => false, 'message' => 'Invalid CSRF token']);
    exit;
}

// Check if we have the transaction ID
if (!isset($_POST['transaction_id'])) {
    echo json_encode(['success' => false, 'message' => 'Missing transaction ID']);
    exit;
}

// Sanitize input
$transactionId = mysqli_real_escape_string($conn, $_POST['transaction_id']);

// Delete transaction from database
$sql = "DELETE FROM transactions WHERE id = '$transactionId'";

if (mysqli_query($conn, $sql)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => mysqli_error($conn)]);
}

mysqli_close($conn);
?>