<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f4f4;
        }

        /* Navbar Styles */
        .navbar {
            background: #0072ff;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .logo img {
            height: 60px; /* Adjust logo size */
        }

        .nav-links {
            display: flex;
            gap: 20px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            transition: 0.3s;
        }

        .nav-links a:hover {
            text-decoration: underline;
        }

        /* User Dropdown */
        .user-menu {
            position: relative;
            cursor: pointer;
            padding: 10px;
            background: #005bb5;
            border-radius: 5px;
        }

        .user-menu:hover {
            background: #003d82;
        }

        .user-menu span {
            font-size: 16px;
            color: white;
            margin-right: 10px;
        }

        .user-dropdown {
            position: absolute;
            right: 0;
            top: 40px;
            background: white;
            color: black;
            border-radius: 5px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            display: none;
            min-width: 150px;
            padding: 10px;
        }

        .user-dropdown a {
            display: block;
            padding: 8px 15px;
            text-decoration: none;
            color: black;
            transition: 0.3s;
        }

        .user-dropdown a:hover {
            background: #0072ff;
            color: white;
        }

        .user-menu:hover .user-dropdown {
            display: block;
        }

        /* Banner */
        .banner {
            margin-top: 70px;
            width: 100%;
            height: 300px;
            background: url('banner.jpg') no-repeat center center/cover;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 32px;
            font-weight: bold;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
        }

        /* About Us Section */
        .about {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 50px;
            background: #fff;
            gap: 30px;
            flex-wrap: wrap;
        }

        .about img {
            width: 300px;
            border-radius: 10px;
        }

        .about-text {
            max-width: 600px;
        }

        .about h2 {
            color: #0072ff;
            margin-bottom: 20px;
        }

        .about p {
            font-size: 18px;
            color: #555;
        }

        /* Contact Section */
        .contact {
            padding: 50px;
            text-align: center;
            background: #eaeaea;
        }

        .contact h2 {
            color: #0072ff;
            margin-bottom: 20px;
        }

        .contact form {
            max-width: 500px;
            margin: auto;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .contact input, .contact textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .contact button {
            background: #0072ff;
            color: white;
            border: none;
            padding: 12px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
        }

        .contact button:hover {
            background: #005bb5;
        }

        /* Footer */
        .footer {
            background: #0072ff;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 30px;
        }

        .footer img {
            height: 40px;
            margin-bottom: 10px;
        }

        .footer a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
            font-size: 16px;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        /* Copyright Section */
        .copyright {
            background: #000000;
            color: white;
            text-align: center;
            padding: 10px;
            font-size: 14px;
        }

        .copyright a {
            color: #ffdd57;
            text-decoration: none;
            font-weight: bold;
        }

        .copyright a:hover {
            text-decoration: underline;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }
            .user-menu {
                margin-top: 10px;
            }
            .about {
                flex-direction: column;
                text-align: center;
            }
            .about img {
                width: 100%;
                max-width: 400px;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">
            <img src="logo.png" alt="Logo">
        </div>
        <div class="nav-links">
            <a href="service_development.php">Development</a>
            <a href="service_designing.php">Designing</a>
            <a href="service_writing.php">Writing</a>
        </div>
        <div class="user-menu">
            <span><?php echo $_SESSION['user_name']; ?></span> ⌄
            <div class="user-dropdown">
                <a href="profile.php">Profile</a>
                <a href="login.php">Logout</a>
            </div>
        </div>
    </div>

    <!-- Banner -->
    <div class="banner">
        Welcome to Our Website
    </div>

    <!-- About Us Section -->
    <div class="about">
        <img src="about-us.jpg" alt="About Us">
        <div class="about-text">
            <h2>About Us</h2>
            <p>We provide high-quality services in **Development, Designing, and Writing** to meet your business needs. Our team is dedicated to delivering top-notch solutions tailored to your requirements.</p>
        </div>
    </div>

    <!-- Contact Form Section -->
    <div class="contact">
        <h2>Contact Us</h2>
        <form action="contact_process.php" method="post">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
            <button type="submit">Send Message</button>
        </form>
    </div>

    <!-- Footer -->
    <div class="footer">
        <img src="logo.png" alt="Footer Logo">
        <div>
            <a href="service_development.php">Development</a> |  
            <a href="service_designing.php">Designing</a> |  
            <a href="service_writing.php">Writing</a>
        </div>
    </div>

    <!-- Copyright Section -->
    <div class="copyright">
        <p>&copy; 2025 Your Website. All Rights Reserved. | Designed by <a href="#">Mohd. Farhan</a></p>
    </div>

</body>
</html>
