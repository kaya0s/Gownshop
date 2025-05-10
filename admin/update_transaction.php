<?php
require_once '../includes/connection_db.php';
require '../vendor/autoload.php'; // PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
$stmt = mysqli_prepare($conn, "SELECT t.*, u.email FROM transactions t 
       JOIN users u ON t.user_id = u.id 
       WHERE t.id = ?");

if (!$stmt) {
    die('Failed to prepare statement: ' . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, 'i', $transactionId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result || mysqli_num_rows($result) === 0) {
    mysqli_stmt_close($stmt);
    die('Transaction not found.');
}

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
        if (!$stmt) {
            die('Failed to prepare statement: ' . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt, 'i', $transactionId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        // Mark gown as unavailable
        $stmt = mysqli_prepare($conn, "UPDATE gowns SET available = 0 WHERE id = ?");
        if (!$stmt) {
            die('Failed to prepare statement: ' . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt, 'i', $gown['id']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // Send confirmation email
        if (isset($transaction['email'])) {
            // Check if email settings are configured
            if (!isset($_ENV['EMAIL_ADMIN']) || !isset($_ENV['EMAIL_PASS'])) {
                error_log('Email configuration missing');
            } else {
                $mail = new PHPMailer(true);
                try { 
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = $_ENV['EMAIL_ADMIN']; 
                    $mail->Password   = $_ENV['EMAIL_PASS'];
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port       = 587;

                    $mail->setFrom($_ENV['EMAIL_ADMIN'], 'HJ Gownshop');
                    $mail->addAddress($transaction['email'], 'User');

                    $mail->isHTML(true);

                    $currentDate = date('Y-m-d');
                    $returnDate = date('Y-m-d', strtotime('+5 days'));
                    
                    $mail->Subject = 'Your gown booking request is accepted - Immediate Delivery';
                    $mail->Body = "
                        <div style='font-family: Arial, sans-serif; background-color: #f5f5f5; padding: 30px;'>
                            <div style='max-width: 600px; margin: auto; background-color: #ffffff; padding: 30px; border-radius: 5px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1);'>
                                <div style='text-align: center; margin-bottom: 25px;'>
                                    <img src='https://scontent-hkg1-1.xx.fbcdn.net/v/t39.30808-6/428620989_838248838344164_2867873167399454704_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeHhsXN7XNuuzU15qzVcwwAmxh1BRseCTGbGHUFGx4JMZpqBBQKKnXIXYfFYMyyp_h7ydluzp7FQB6pMB0GXy10V&_nc_ohc=F-eE5Q5FpB8Q7kNvwEq1mNU&_nc_oc=AdnH-OVjQnh1SAgSBH8IxGEQNGrEK6vJLhw8A2z9t8k5gpUJjtyVfZejCam29F0uplI&_nc_zt=23&_nc_ht=scontent-hkg1-1.xx&_nc_gid=xdHYevBGymBcSaJZAL4XVw&oh=00_AfLQApNIq8g9kYDZ7jCUyrkYs5OXI4qyb1vP400q9z58Gg&oe=682518D0' alt='Company Logo' style='max-width: 150px; height: auto;'>
                                </div>
                                <h2 style='color: #333333; text-align: center; margin-bottom: 20px;'>Booking Confirmation</h2>
                                <p style='color: #555555; font-size: 16px; line-height: 1.5;'>Dear Customer,</p>
                                <p style='color: #555555; font-size: 16px; line-height: 1.5;'>We are delighted to inform you that your request to book a gown has been <strong>approved and confirmed</strong>.</p>
                                <div style='background-color: #f9f9f9; border-left: 4px solid #4CAF50; padding: 15px; margin: 20px 0;'>
                                    <p style='color: #333333; font-size: 16px; margin: 0;'><strong>Important Information:</strong></p>
                                    <p style='color: #555555; font-size: 16px; margin-top: 10px;'>We will deliver your gown <strong>immediately</strong> following this email.</p>
                                    <p style='color: #555555; font-size: 16px; margin-top: 5px;'><strong>Please return the gown by: $returnDate</strong></p>
                                </div>
                                <p style='color: #555555; font-size: 16px; line-height: 1.5;'>Here are the details of your booking:</p>
                                <ul style='color: #555555; font-size: 16px; line-height: 1.8;'>
                                    <li><strong>Gown Name:</strong> {$gown['name']};</li>
                                    <li><strong>Booking Date:</strong> $currentDate</li>
                                    <li><strong>Delivery:</strong> Immediate</li>
                                    <li><strong>Return Date:</strong>$returnDate</li>
                                </ul>
                                <h3 style='color: #333333; margin-top: 25px;'>Care Instructions:</h3>
                                <p style='color: #555555; font-size: 16px; line-height: 1.5;'>To keep the gown in excellent condition, please:</p>
                                <ul style='color: #555555; font-size: 16px; line-height: 1.8;'>
                                    <li>Handle with clean hands</li>
                                    <li>Avoid food, drinks, and makeup stains</li>
                                    <li>Keep away from pets</li>
                                    <li>Store hanging in the provided garment bag</li>
                                    <li>Do not attempt to clean or modify the gown yourself</li>
                                </ul>
                                <p style='color: #555555; font-size: 16px; line-height: 1.5;'>If you have any questions about how to care for your gown or need to adjust your return date, please contact us immediately.</p>
                                <p style='color: #555555; font-size: 16px; line-height: 1.5;'>We trust you'll look stunning in our gown for your special occasion!</p>
                                <div style='margin-top: 30px; padding-top: 20px; border-top: 1px solid #eeeeee;'>
                                    <p style='color: #777777; font-size: 14px;'>Thank you for choosing our service!</p>
                                    <p style='color: #777777; font-size: 14px;'>Best regards,<br>The HJ Gownshop Team</p>
                                </div>
                                <div style='margin-top: 30px; text-align: center;'>
                                    <p style='color: #999999; font-size: 12px;'>If you have any questions, please contact us at:<br> HJ_Gownshop@gmail.com or 096641882</p>
                                    <p style='color: #999999; font-size: 12px;'>&copy; " . date('Y') . " [Your Company Name]. All rights reserved.</p>
                                </div>
                            </div>
                        </div>";
                    $mail->AltBody = "Your gown booking request is accepted";
                    $mail->send();
                    
                    // Start session if not already started
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }
                    $_SESSION['success'] = "Booking accepted and confirmation email sent.";
                } catch (Exception $e) {
                    // Start session if not already started
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }
                    $_SESSION['error'] = "Booking accepted but email failed: " . $mail->ErrorInfo;
                    error_log("Email sending failed: " . $mail->ErrorInfo);
                }
            }
        }

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
            
                    // Send rejection email
            if (isset($transaction['email'])) {
                // Check if email settings are configured
                if (!isset($_ENV['EMAIL_ADMIN']) || !isset($_ENV['EMAIL_PASS'])) {
                    error_log('Email configuration missing');
                } else {
                    $mail = new PHPMailer(true);
                    try { 
                        $mail->isSMTP();
                        $mail->Host       = 'smtp.gmail.com';
                        $mail->SMTPAuth   = true;
                        $mail->Username   = $_ENV['EMAIL_ADMIN']; 
                        $mail->Password   = $_ENV['EMAIL_PASS'];
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port       = 587;

                        $mail->setFrom($_ENV['EMAIL_ADMIN'], 'HJ Gownshop');
                        $mail->addAddress($transaction['email'], 'User');

                        $mail->isHTML(true);

                        $currentDate = date('Y-m-d');
                        
                        $mail->Subject = 'Your gown booking request has been declined';
                        $mail->Body = "
                            <div style='font-family: Arial, sans-serif; background-color: #f5f5f5; padding: 30px;'>
                                <div style='max-width: 600px; margin: auto; background-color: #ffffff; padding: 30px; border-radius: 5px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1);'>
                                    <div style='text-align: center; margin-bottom: 25px;'>
                                        <img src='https://scontent-hkg1-1.xx.fbcdn.net/v/t39.30808-6/428620989_838248838344164_2867873167399454704_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeHhsXN7XNuuzU15qzVcwwAmxh1BRseCTGbGHUFGx4JMZpqBBQKKnXIXYfFYMyyp_h7ydluzp7FQB6pMB0GXy10V&_nc_ohc=F-eE5Q5FpB8Q7kNvwEq1mNU&_nc_oc=AdnH-OVjQnh1SAgSBH8IxGEQNGrEK6vJLhw8A2z9t8k5gpUJjtyVfZejCam29F0uplI&_nc_zt=23&_nc_ht=scontent-hkg1-1.xx&_nc_gid=xdHYevBGymBcSaJZAL4XVw&oh=00_AfLQApNIq8g9kYDZ7jCUyrkYs5OXI4qyb1vP400q9z58Gg&oe=682518D0' alt='Company Logo' style='max-width: 150px; height: auto;'>
                                    </div>
                                    <h2 style='color: #333333; text-align: center; margin-bottom: 20px;'>Booking Request Declined</h2>
                                    <p style='color: #555555; font-size: 16px; line-height: 1.5;'>Dear Customer,</p>
                                    <p style='color: #555555; font-size: 16px; line-height: 1.5;'>We regret to inform you that your request to book a gown has been <strong>declined</strong> at this time.</p>
                                    <div style='background-color: #f9f9f9; border-left: 4px solid #FF5722; padding: 15px; margin: 20px 0;'>
                                        <p style='color: #333333; font-size: 16px; margin: 0;'><strong>Reason for Decline:</strong></p>
                                        <p style='color: #555555; font-size: 16px; margin-top: 10px;'>After careful consideration, we are unable to fulfill your booking request due to {$reason}.</p>
                                    </div>
                                    <p style='color: #555555; font-size: 16px; line-height: 1.5;'>Here are the details of your declined booking:</p>
                                    <ul style='color: #555555; font-size: 16px; line-height: 1.8;'>
                                        <li><strong>Gown Name:</strong> {$gown['name']}</li>
                                        <li><strong>Request Date:</strong> $currentDate</li>
                                    </ul>
                                    <h3 style='color: #333333; margin-top: 25px;'>Alternative Options:</h3>
                                    <p style='color: #555555; font-size: 16px; line-height: 1.5;'>We understand this may be disappointing, but we'd like to offer some alternatives:</p>
                                    <ul style='color: #555555; font-size: 16px; line-height: 1.8;'>
                                        <li>Browse our other available gowns that might suit your needs</li>
                                        <li>Consider booking for a different date when this gown may be available</li>
                                        <li>Speak with our stylists who can recommend similar styles that are currently available</li>
                                    </ul>
                                    <p style='color: #555555; font-size: 16px; line-height: 1.5;'>If you'd like to discuss this further or explore other options, please don't hesitate to contact us. We're here to help you find the perfect gown for your special occasion.</p>
                                    <div style='margin-top: 30px; padding-top: 20px; border-top: 1px solid #eeeeee;'>
                                        <p style='color: #777777; font-size: 14px;'>Thank you for your understanding.</p>
                                        <p style='color: #777777; font-size: 14px;'>Best regards,<br>The HJ Gownshop Team</p>
                                    </div>
                                    <div style='margin-top: 30px; text-align: center;'>
                                        <p style='color: #999999; font-size: 12px;'>If you have any questions, please contact us at:<br> HJ_Gownshop@gmail.com or 096641882</p>
                                        <p style='color: #999999; font-size: 12px;'>&copy; " . date('Y') . " HJ Gownshop. All rights reserved.</p>
                                    </div>
                                </div>
                            </div>";
                        $mail->AltBody = "Your gown booking request has been declined";
                        $mail->send();
                        
                        // Start session if not already started
                        if (session_status() == PHP_SESSION_NONE) {
                            session_start();
                        }
                        $_SESSION['success'] = "Booking declined and notification email sent.";
                    } catch (Exception $e) {
                        // Start session if not already started
                        if (session_status() == PHP_SESSION_NONE) {
                            session_start();
                        }
                        $_SESSION['error'] = "Booking declined but email failed: " . $mail->ErrorInfo;
                        error_log("Email sending failed: " . $mail->ErrorInfo);
                    }
                }
            }
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
        
        // Start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['success'] = "Gown marked as returned.";
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
        
        // Start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['success'] = "Transaction deleted and gown marked as available.";
        break;
        
    default:
        die('Unexpected action.');
}

// Redirect back to the previous page
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;