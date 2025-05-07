<?php

require_once '../includes/connection_db.php'; 

if (!isset($_POST['id'], $_POST['action'])) {
    die('Invalid request.');
}

//sanitize
$transactionId = intval($_POST['id']);
$action = trim($_POST['action']);

// Validate action
$validActions = ['accept', 'reject', 'return', 'delete'];
if (!in_array($action, $validActions)) {
    die('Invalid action.');
}

// Process the action
$res = mysqli_query($conn ,"select * from transactions");
$trans  = mysqli_fetch_assoc($res);

switch ($action) {

    //ACCEPT BOOKING
    case 'accept':
        $query = "UPDATE transactions  SET status = 'rented' WHERE id = ?";
        mysqli_query($conn,"UPDATE transactions set date_rented = CURDATE() where id = ". $transactionId."  ");
        $result = mysqli_query($conn,"select * from gowns where id = ".$trans['gown_id'] ." ");
        $gown = mysqli_fetch_assoc($result);
        mysqli_query($conn,"UPDATE gowns  SET available = null WHERE id =".$gown['id']." ");
       break;
    //REJECT BOOKING
    case 'reject':
        $query = "DELETE FROM transactions WHERE id = ?";
        mysqli_query($conn,"delete from transactions where id = ". $transactionId."  ");
        break;
    //RETURN GOWN
    case 'return':
        $query = "UPDATE transactions SET status = 'returned' WHERE id = ?";
        mysqli_query($conn,"UPDATE transactions set date_returned = CURDATE() where id = ". $transactionId."  ");
        $result = mysqli_query($conn,"select * from gowns where id = ".$trans['gown_id'] ." ");
        $gown = mysqli_fetch_assoc($result);
        mysqli_query($conn,"UPDATE gowns  SET available = 1  WHERE id =".$gown['id']." ");
        break;

    //DELETE TRANSACTION
    case 'delete':
        $query = "DELETE FROM transactions WHERE id = ?";
        mysqli_query($conn,"UPDATE transactions set date_returned = CURDATE() where id = ". $transactionId."  ");
        $result = mysqli_query($conn,"select * from gowns where id = ".$trans['gown_id'] ." ");
        $gown = mysqli_fetch_assoc($result);
        mysqli_query($conn,"UPDATE gowns  SET available = 1  WHERE id =".$gown['id']." ");
        break;

    default:
        die('Unexpected action.');
}

// Prepare and execute the query
$stmt = mysqli_prepare($conn, $query);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'i', $transactionId);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        // Redirect back to the previous page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        die('Database operation failed: ' . mysqli_error($conn));
    }
} else {
    die('Failed to prepare statement: ' . mysqli_error($conn));
}
