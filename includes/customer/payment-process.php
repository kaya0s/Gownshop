<?php
    session_start();
    require('../connection_db.php');
    // PHPMailer use statements must be at the top
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    if(isset($_SESSION['gown_id']) ){

        $stmt = $conn->prepare("INSERT INTO TRANSACTIONS(user_id,gown_id,total_price) VALUES(?,?,?)");
        $stmt->bind_param("iii",$_SESSION['user_id'], $_SESSION['gown_id'],$_SESSION['price']);

        if($stmt->execute()){
           
            // 10 POINTS ADD IN EVERY 100 POINTS 
            $pointsToAdd = round(($_SESSION['price'] / 100) * 10); 

            $stmt = $conn->prepare("UPDATE users SET suki_points = suki_points + ? WHERE id = ?");
            
            $userId = $_SESSION['user_id'];
            $stmt->bind_param("ii", $pointsToAdd, $_SESSION['user_id']);

            if($stmt->execute()){
                // --- SEND EMAIL TO ADMIN USING PHPMailer SMTP ---
                require_once '../../vendor/autoload.php'; // Composer autoload for PHPMailer

                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = $_ENV['EMAIL_ADMIN']; // Your SMTP username (Gmail address)
                    $mail->Password   = $_ENV['EMAIL_PASS']; // Your SMTP password or app password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port       = 587;

                    $mail->setFrom($_ENV['EMAIL_ADMIN'], 'Gownshop Booking');
                    $mail->addAddress($_ENV['EMAIL_ADMIN']); 

                    $mail->isHTML(true);
                    $mail->Subject = 'New Gown Booking Request - HJ Gownshop';

                    $currentDate = date('Y-m-d');
                    $bust = isset($_SESSION['size-bust']) ? $_SESSION['size-bust'] : '';
                    $waist = isset($_SESSION['size-waist']) ? $_SESSION['size-waist'] : '';
                    $hips = isset($_SESSION['size-hips']) ? $_SESSION['size-hips'] : '';
                    $length = isset($_SESSION['size-length']) ? $_SESSION['size-length'] : '';
                    $userEmail = isset($_SESSION['email']) ? $_SESSION['email'] : '';

                    $body = "
                        <div style='font-family: Arial, sans-serif; background-color: #f5f5f5; padding: 30px;'>
                            <div style='max-width: 600px; margin: auto; background-color: #ffffff; padding: 30px; border-radius: 5px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1);'>
                                <div style='text-align: center; margin-bottom: 25px;'>
                                    <img src='https://scontent-hkg1-1.xx.fbcdn.net/v/t39.30808-6/428620989_838248838344164_2867873167399454704_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeHhsXN7XNuuzU15qzVcwwAmxh1BRseCTGbGHUFGx4JMZpqBBQKKnXIXYfFYMyyp_h7ydluzp7FQB6pMB0GXy10V&_nc_ohc=F-eE5Q5FpB8Q7kNvwEq1mNU&_nc_oc=AdnH-OVjQnh1SAgSBH8IxGEQNGrEK6vJLhw8A2z9t8k5gpUJjtyVfZejCam29F0uplI&_nc_zt=23&_nc_ht=scontent-hkg1-1.xx&_nc_gid=xdHYevBGymBcSaJZAL4XVw&oh=00_AfLQApNIq8g9kYDZ7jCUyrkYs5OXI4qyb1vP400q9z58Gg&oe=682518D0' alt='Company Logo' style='max-width: 150px; height: auto;'>
                                </div>
                                <h2 style='color:#041623; text-align: center; margin-bottom: 20px;'>New Gown Booking Request</h2>
                                <p style='color: #555555; font-size: 16px; line-height: 1.5;'>A customer has just submitted a new gown booking request. Please review the details below and process the booking as soon as possible.</p>
                                <div style='background-color: #f9f9f9; border-left: 4px solid #4CAF50; padding: 15px; margin: 20px 0;'>
                                    <p style='color: #333333; font-size: 16px; margin: 0;'><strong>Booking Date:</strong> $currentDate</p>
                                </div>
                                <h3 style='color:#041623; margin-bottom:8px;'>Booking Details</h3>
                                <ul style='color: #555555; font-size: 16px; line-height: 1.8;'>
                                    <li><strong>User ID:</strong> " . htmlspecialchars($_SESSION['user_id']) . "</li>
                                    <li><strong>User Email:</strong> " . htmlspecialchars($userEmail) . "</li>
                                    <li><strong>Gown ID:</strong> " . htmlspecialchars($_SESSION['gown_id']) . "</li>
                                    <li><strong>Total Price:</strong> ₱" . htmlspecialchars($_SESSION['price']) . "</li>
                                </ul>
                                <h3 style='color:#041623; margin-bottom:8px;'>Customized Size</h3>
                                <ul style='color: #555555; font-size: 16px; line-height: 1.8;'>
                                    <li><strong>Bust:</strong> " . htmlspecialchars($bust) . "</li>
                                    <li><strong>Waist:</strong> " . htmlspecialchars($waist) . "</li>
                                    <li><strong>Hips:</strong> " . htmlspecialchars($hips) . "</li>
                                    <li><strong>Length:</strong> " . htmlspecialchars($length) . "</li>
                                </ul>
                                <div style='margin-top: 30px; padding-top: 20px; border-top: 1px solid #eeeeee;'>
                                    <p style='color: #777777; font-size: 14px;'>Please log in to the admin panel to review and manage this booking.</p>
                                    <p style='color: #777777; font-size: 14px;'>Best regards,<br>The HJ Gownshop System</p>
                                </div>
                                <div style='margin-top: 30px; text-align: center;'>
                                    <p style='color: #999999; font-size: 12px;'>This is an automated notification for admin use only.</p>
                                </div>
                            </div>
                        </div>
                    ";
                    $mail->Body = $body;
                    $mail->send();
                } catch (Exception $e) {
                    error_log('Mailer Error: ' . $mail->ErrorInfo);
                }
                // --- END EMAIL ---

                $_SESSION['successmsg'] ="PAYMENT SUCCESSFULLY PLEASE WAIT FOR THE CONFIRMATION EMAIL. ". $pointsToAdd." POINTS ADDED";
            header("location: ../../customer/homepage.php");
            exit();
            }else{
                echo"error";
            }
            
            
        
            
        }else{
            $_SESSION['errormsg'] ="Error Payment";
            
            header("location: ../../customer/payment.php");
            exit();
        }

    }else{
        $_SESSION['errormsg'] = "gown id not set";
        header("location:  ../../customer/homepage.php");
    }




?>

