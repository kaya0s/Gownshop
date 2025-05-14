<?php
session_start();
require('../includes/connection_db.php');
require '../vendor/autoload.php'; // PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if($_SERVER['REQUEST_METHOD'] == "POST" ){    
    

    
    $insert = $conn->prepare("INSERT INTO transactions (user_id, gown_id, payment_method, status, total_price) VALUES (?, ?, 'over_the_counter', 'pending', ?)");
    $insert->bind_param("iii", $_SESSION['user_id'], $_SESSION['gown_id'], $_SESSION['price']);
    $insert->execute();

    $query = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $query->bind_param("i", $_SESSION['user_id']);
    $query->execute();
    $result = $query->get_result();
    $user = $result->fetch_assoc();
    
    if (isset($user['email'])) {
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
                    $mail->addAddress($user['email'], 'User');

                    $mail->isHTML(true);

                    $currentDate = date('Y-m-d');
                    $returnDate = date('Y-m-d', strtotime('+5 days'));
                    
                    $mail->Subject = 'Gown is reserved for you - Pay and Claim Within 24 Hours';
                    $mail->Body = "
                    <link href='https://fonts.googleapis.com/css2?family=Aboreto&display=swap' rel='stylesheet'>
                    <div style='font-family: \"Aboreto\", Arial, sans-serif; background-color: #f5f5f5; padding: 30px;'>
                        <div style='max-width: 600px; margin: auto; background-color: #ffffff; padding: 30px; border-radius: 5px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); font-family: \"Aboreto\", Arial, sans-serif;'>
                            <div style='text-align: center; margin-bottom: 25px;'>
                                <img src='https://scontent-hkg1-1.xx.fbcdn.net/v/t39.30808-6/428620989_838248838344164_2867873167399454704_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeHhsXN7XNuuzU15qzVcwwAmxh1BRseCTGbGHUFGx4JMZpqBBQKKnXIXYfFYMyyp_h7ydluzp7FQB6pMB0GXy10V&_nc_ohc=F-eE5Q5FpB8Q7kNvwEq1mNU&_nc_oc=AdnH-OVjQnh1SAgSBH8IxGEQNGrEK6vJLhw8A2z9t8k5gpUJjtyVfZejCam29F0uplI&_nc_zt=23&_nc_ht=scontent-hkg1-1.xx&_nc_gid=xdHYevBGymBcSaJZAL4XVw&oh=00_AfLQApNIq8g9kYDZ7jCUyrkYs5OXI4qyb1vP400q9z58Gg&oe=682518D0' alt='Company Logo' style='max-width: 150px; height: auto;'>
                            </div>
                            <h2 style='color: #333333; text-align: center; margin-bottom: 20px;'>Booking Confirmation</h2>
                            <p style='color: #555555; font-size: 16px; line-height: 1.5;'>Dear Customer,</p>
                            <p style='color: #555555; font-size: 16px; line-height: 1.5;'>We are happy to inform you that your request to book a gown has been <strong>approved and confirmed</strong>.</p>
                            <div style='background-color: #f9f9f9; border-left: 4px solid #4CAF50; padding: 15px; margin: 20px 0;'>
                                <p style='color: #333333; font-size: 16px; margin: 0;'><strong>Important Instructions:</strong></p>
                                <p style='color: #555555; font-size: 16px; margin-top: 10px;'>Please <strong>pay at the counter within 24 hours</strong> to claim your gown.</p>
                                <p style='color: #555555; font-size: 16px; margin-top: 5px;'>You will receive your gown immediately after payment.</p>
                                <p style='color: #555555; font-size: 16px; margin-top: 5px;'><strong>Please return the gown by: $returnDate</strong></p>
                            </div>
                            <p style='color: #555555; font-size: 16px; line-height: 1.5;'>Here are the details of your booking:</p>
                            <ul style='color: #555555; font-size: 16px; line-height: 1.8;'>
                                <li><strong>Gown Name:</strong>{$_SESSION['gown_name']}</li>
                                <li><strong>Booking Date:</strong> $currentDate</li>
                                <li><strong>Pick-up Method:</strong> Pay & Claim at Counter</li>
                                <li><strong>Return Date:</strong> $returnDate</li>
                            </ul>
                            <h3 style='color: #333333; margin-top: 25px;'>Care Instructions:</h3>
                            <ul style='color: #555555; font-size: 16px; line-height: 1.8;'>
                                <li>Handle with clean hands</li>
                                <li>Avoid food, drinks, and makeup stains</li>
                                <li>Keep away from pets</li>
                                <li>Store hanging in the provided garment bag</li>
                                <li>Do not attempt to clean or modify the gown yourself</li>
                            </ul>
                            <p style='color: #555555; font-size: 16px; line-height: 1.5;'>If you have any questions or need to adjust your return date, please contact us immediately.</p>
                            <div style='margin-top: 30px; padding-top: 20px; border-top: 1px solid #eeeeee;'>
                                <p style='color: #777777; font-size: 14px;'>Thank you for choosing our service!</p>
                                <p style='color: #777777; font-size: 14px;'>Best regards,<br>The HJ Gownshop Team</p>
                            </div>
                            <div style='margin-top: 30px; text-align: center;'>
                                <p style='color: #999999; font-size: 12px;'>If you have any questions, please contact us at:<br> HJ_Gownshop@gmail.com or 096641882</p>
                                <p style='color: #999999; font-size: 12px;'>&copy; " . date('Y') . " HJ Gownshop. All rights reserved.</p>
                            </div>
                        </div>
                    </div>";
                    $mail->AltBody = "Your gown booking is accepted. Pay at the counter within 24 hours to claim your gown.";


                    $mail->send();
                    
                    // Start session if not already started
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }
                    //REMOVING GOWN SESSIONS FROM COOKIE
                     unset($_SESSION['gown_name'],$_SESSION['price'],$_SESSION['gown_id']);
                     $_SESSION['successmsg'] = "PLEASE PAY OVER THE COUNTER WITH IN 24 HRS WE HAVE SENT AN EMAIL FOR THE PROCEDURE";
                    usleep(500000);
                    header('location: homepage.php');
                    exit();
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

}




?>