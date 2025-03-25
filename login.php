<?php
session_start();
require 'db.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        if ($user['status'] == 1) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: dashboard.php");
        } else {
            $error = "Verify your email before logging in.";
        }
    } else {
        $error = "Invalid credentials.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
       .input-container {
           position: relative;
           width: 100%;
       }

       input {
           width: 100%;
           padding: 12px;
           padding-right: 40px;
           margin: 12px 0;
           border: 2px solid #ddd;
           border-radius: 8px;
           font-size: 14px;
           transition: all 0.3s ease-in-out;
           background-color: #f9f9f9;
           text-align: center;
       }

       input:focus {
           border-color: #1e3c72;
           outline: none;
           background-color: #fff;
           box-shadow: 0 0 10px rgba(30, 60, 114, 0.3);
       }

       /* Eye Icon */
       .toggle-password {
           position: absolute;
           top: 50%;
           right: 10px;
           transform: translateY(-50%);
           cursor: pointer;
           font-size: 18px;
           color: #555;
       }

       .toggle-password:hover {
           color: #1e3c72;
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

       /* Links */
       .forgot-password, .register-link {
           display: block;
           margin-top: 10px;
           text-decoration: none;
           font-size: 14px;
           font-weight: bold;
           transition: color 0.3s ease-in-out;
       }

       .forgot-password {
           color: #1e3c72;
       }

       .register-link {
           color: #ff6a00;
       }

       .forgot-password:hover, .register-link:hover {
           text-decoration: underline;
           color: #ee0979;
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
        <h2>Login</h2>

        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>

        <form method="post">
            <input type="email" name="email" required placeholder="Email">
            
            <div class="input-container">
                <input type="password" name="password" id="password" required placeholder="Password">
                <span class="toggle-password" onclick="togglePassword()">👁️</span>
            </div>

            <button type="submit" name="login">Login</button>
            <a href="forgot_password.php" class="forgot-password">Forgot Password?</a>
            <a href="register.php" class="register-link">Create account - Register Now</a>
        </form>
    </div>

    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            var toggleIcon = document.querySelector(".toggle-password");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.innerHTML = "🙈"; // Change to hidden eye icon
            } else {
                passwordField.type = "password";
                toggleIcon.innerHTML = "👁️"; // Change to open eye icon
            }
        }
    </script>

</body>
</html>
