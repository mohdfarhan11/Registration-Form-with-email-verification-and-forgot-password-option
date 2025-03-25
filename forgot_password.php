<?php
session_start();
require 'db.php';

// Load PHPMailer
require __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_otp'])) {
    $email = trim($_POST['email']);

    // Check if email exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Generate OTP
        $otp = rand(100000, 999999);
        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $email;
        $_SESSION['reset_allowed'] = true;

        // Send OTP via PHPMailer
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'mail.getyourwebsite.store'; // Updated SMTP Host
            $mail->SMTPAuth = true;
            $mail->Username = 'farhan@getyourwebsite.store'; // Updated Email
            $mail->Password = 'Farhan@123#'; // Updated Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // SSL Encryption
            $mail->Port = 465;

            $mail->setFrom('farhan@getyourwebsite.store', 'Farhan');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = "Password Reset OTP";
            $mail->Body = "<p>Your OTP for password reset is: <b>$otp</b></p>";

            if ($mail->send()) {
                header("Location: verify__otp.php"); // ✅ Updated link
                exit();
            } else {
                $message = "<p style='color: red; text-align:center;'>Error sending email. Try again.</p>";
            }
        } catch (Exception $e) {
            $message = "<p style='color: red; text-align:center;'>Mailer Error: " . $mail->ErrorInfo . "</p>";
        }
    } else {
        $message = "<p style='color: red; text-align:center;'>Email not found!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
      /* General Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    background: linear-gradient(135deg, #1e3c72, #2a5298);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    padding: 20px;
}

/* Container */
.container {
    background: white;
    padding: 35px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    width: 100%;
    max-width: 400px;
    text-align: center;
    animation: fadeIn 0.6s ease-in-out;
    transition: transform 0.3s ease-in-out;
}

.container:hover {
    transform: translateY(-5px);
}

h2 {
    color: #222;
    margin-bottom: 20px;
    font-size: 24px;
    font-weight: bold;
}

/* Input Fields */
input {
    width: 100%;
    padding: 12px;
    margin: 12px 0;
    border: 2px solid #ddd;
    border-radius: 8px;
    font-size: 14px;
    transition: all 0.3s ease-in-out;
    background-color: #f9f9f9;
}

input:focus {
    border-color: #1e3c72;
    outline: none;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(30, 60, 114, 0.3);
}

/* Small & Centered Button */
.button-container {
    display: flex;
    justify-content: center;
}

button {
    padding: 8px 15px;
    background: linear-gradient(90deg, #ff6a00, #ee0979);
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: transform 0.2s ease, background 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    width: 50%;
    text-transform: uppercase;
    letter-spacing: 1px;
}

button:hover {
    background: linear-gradient(90deg, #ee0979, #ff6a00);
    transform: scale(1.05);
    box-shadow: 0 8px 20px rgba(255, 106, 0, 0.3);
}

button:active {
    transform: scale(0.98);
    box-shadow: none;
}

/* Error Message */
.error {
    color: red;
    font-size: 14px;
    margin-bottom: 10px;
    animation: fadeIn 0.5s ease-in-out;
}

/* Responsive Design */
@media (max-width: 768px) {
    body {
        padding: 10px;
    }
    .container {
        width: 90%;
    }
}

@media (max-width: 480px) {
    .container {
        width: 95%;
        padding: 20px;
    }
    input {
        font-size: 14px;
    }
    button {
        font-size: 14px;
        width: 60%;
    }
}

/* Animations */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Forgot Password</h2>
        <?php echo $message; ?>
        <form method="post">
            <input type="email" name="email" required placeholder="Enter your email">
            <button type="submit" name="send_otp">Send OTP</button>
        </form>
    </div>
</body>
</html>
