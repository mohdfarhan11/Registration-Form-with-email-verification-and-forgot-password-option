<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer
require __DIR__ . '/vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $message = htmlspecialchars($_POST['message']);

    if (!$email) {
        die("Invalid email format.");
    }

    $mail = new PHPMailer(true);

    try {
        // SMTP Server Settings
        $mail->isSMTP();
        $mail->Host = 'mail.getyourwebsite.store'; // Your SMTP Host
        $mail->SMTPAuth = true;
        $mail->Username = 'farhan@getyourwebsite.store'; // Your SMTP Email
        $mail->Password = 'Farhan@123#'; // Your SMTP Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // SSL Encryption
        $mail->Port = 465; // SSL Port

        // Sender & Recipient
        $mail->setFrom('farhan@getyourwebsite.store', 'Farhan'); // Your Email & Name
        $mail->addAddress('farhan@getyourwebsite.store', 'Admin'); // Admin Email
        $mail->addReplyTo($email, $name); // User's Reply-To

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = "New Contact Form Submission from $name";
        $mail->Body    = "
            <h3>Contact Form Submission</h3>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Message:</strong><br>$message</p>
        ";

        // Send Email
        if ($mail->send()) {
            header("Location: dashboard.php?success=Message sent successfully");
            exit();
        } else {
            header("Location: dashboard.php?error=Failed to send message");
            exit();
        }
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
} else {
    header("Location: dashboard.php");
    exit();
}
?>
