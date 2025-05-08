<?php

require_once '../includes/connection_db.php';

// Check for valid request
if (!isset($_POST['id'], $_POST['action'])) {
    die('Invalid request.');
}

// Sanitize inputs
$transactionId = intval($_POST['id']);
$action = trim($_POST['action']);

// Validate action
$validActions = ['accept', 'reject', 'return', 'delete'];
if (!in_array($action, $validActions)) {
    die('Invalid action.');
}

// Get transaction data first
$stmt = mysqli_prepare($conn, "SELECT * FROM transactions WHERE id = ?");

mysqli_stmt_bind_param($stmt, 'i', $transactionId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);


$transaction = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

// Get associated gown data
$stmt = mysqli_prepare($conn, "SELECT * FROM gowns WHERE id = ?");
if (!$stmt) {
    die('Failed to prepare statement: ' . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, 'i', $transaction['gown_id']);
mysqli_stmt_execute($stmt);
$gownResult = mysqli_stmt_get_result($stmt);

if (!$gownResult || mysqli_num_rows($gownResult) === 0) {
    mysqli_stmt_close($stmt);
    die('Associated gown not found.');
}

$gown = mysqli_fetch_assoc($gownResult);
mysqli_stmt_close($stmt);

// Process the action
switch ($action) {
    case 'accept':
        // Update transaction status to rented
        $stmt = mysqli_prepare($conn, "UPDATE transactions SET status = 'rented', date_rented = CURDATE() WHERE id = ?");

        mysqli_stmt_bind_param($stmt, 'i', $transactionId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        // Mark gown as unavailable
        $stmt = mysqli_prepare($conn, "UPDATE gowns SET available = NULL WHERE id = ?");
        if (!$stmt) {
            die('Failed to prepare statement: ' . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt, 'i', $gown['id']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        break;
        
    case 'reject':
        // Delete the transaction
        $stmt = mysqli_prepare($conn, "DELETE FROM transactions WHERE id = ?");
        if (!$stmt) {
            die('Failed to prepare statement: ' . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt, 'i', $transactionId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        break;
        
    case 'return':
        // Update transaction status to returned
        $stmt = mysqli_prepare($conn, "UPDATE transactions SET status = 'returned', date_returned = CURDATE() WHERE id = ?");
        if (!$stmt) {
            die('Failed to prepare statement: ' . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt, 'i', $transactionId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        // Mark gown as available again
        $stmt = mysqli_prepare($conn, "UPDATE gowns SET available = 1 WHERE id = ?");
        if (!$stmt) {
            die('Failed to prepare statement: ' . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt, 'i', $gown['id']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        break;
        
    case 'delete':
        // Delete the transaction and make gown available again
        $stmt = mysqli_prepare($conn, "DELETE FROM transactions WHERE id = ?");
        if (!$stmt) {
            die('Failed to prepare statement: ' . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt, 'i', $transactionId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        // Mark gown as available again
        $stmt = mysqli_prepare($conn, "UPDATE gowns SET available = 1 WHERE id = ?");
        if (!$stmt) {
            die('Failed to prepare statement: ' . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt, 'i', $gown['id']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        break;
        
    default:
        die('Unexpected action.');
}

// Redirect back to the previous page
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;