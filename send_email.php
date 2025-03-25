<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer (Make sure PHPMailer is installed using Composer)
require __DIR__ . '/vendor/autoload.php'; 

function sendOTP($recipientEmail, $otp) {
    $mail = new PHPMailer(true);

    try {
        // SMTP Server Settings
        $mail->isSMTP();
        $mail->Host = 'mail.getyourwebsite.store'; // Your SMTP Host
        $mail->SMTPAuth = true;
        $mail->Username = 'farhan@getyourwebsite.store'; // Your SMTP Email
        $mail->Password = 'Farhan@123#'; // Your SMTP Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // SSL Encryption
        $mail->Port = 465; // Use 465 for SSL

        // Sender & Recipient
        $mail->setFrom('farhan@getyourwebsite.store', 'Farhan');
        $mail->addAddress($recipientEmail); // Recipient Email

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = 'Your OTP Code';
        $mail->Body    = "<p>Your OTP code is: <b>$otp</b></p>";

        // Send Email
        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
        return false;
    }
}
?>
