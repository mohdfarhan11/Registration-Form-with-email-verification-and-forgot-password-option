<?php
session_start();
if (!isset($_SESSION['user_id'])) {
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
            background: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            min-height: 100vh;
            padding-top: ;
        }

        /* Navbar Styles */
        nav {
            background: #0072ff;
            width: 100%;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .logo img {
    height: 60px; /* Adjust the size as needed */
    width: auto; /* Maintains aspect ratio */
}

        /* Navbar Links */
        .nav-links {
            list-style: none;
            display: flex;
            gap: 20px;
        }

        .nav-links li {
            display: inline;
        }

        .nav-links li a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            padding: 10px 15px;
            transition: background 0.3s;
            border-radius: 5px;
        }

        .nav-links li a:hover {
            background: #005bb5;
        }

        /* User Dropdown */
        .user-dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-toggle {
            background: transparent;
            color: white;
            border: none;
            font-size: 18px;
            cursor: pointer;
            padding: 10px;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background: white;
            min-width: 120px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .dropdown-content a {
            color: #333;
            text-decoration: none;
            display: block;
            padding: 10px;
            text-align: left;
            transition: background 0.3s;
        }

        .dropdown-content a:hover {
            background: #f1f1f1;
        }

        .user-dropdown:hover .dropdown-content {
            display: block;
        }

        /* Banner Image */
        .banner {
            width: 100%;
            max-height: 300px;
            overflow: hidden;
            margin-top: 60px;
        }

        .banner img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Welcome Message */
        h1 {
            margin-top: 20px;
            font-size: 24px;
            color: #333;
            text-align: center;
        }

        /* Index Button */
        .btn {
            margin-top: 20px;
            padding: 12px 20px;
            background: #0072ff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn:hover {
            background: #005bb5;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            nav {
                flex-direction: column;
                text-align: center;
                gap: 10px;
            }

            .nav-links {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>

    <nav>
        <!-- Logo on the Left -->
        <div class="logo">
            <img src="logo.png" alt="Logo">
        </div>

        <!-- Navbar Links -->
        <ul class="nav-links">
            <li><a href="service_development.php">Development</a></li>
            <li><a href="service_designing.php">Designing</a></li>
            <li><a href="service_writing.php">Writing</a></li>
        </ul>

        <!-- User Dropdown (Username + Logout) -->
        <div class="user-dropdown">
            <button class="dropdown-toggle"><?= $_SESSION['user_name']; ?> ▼</button>
            <div class="dropdown-content">
                <a href="login.php">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Banner Image -->
    <div class="banner">
        <img src="banner.jpg" alt="Banner Image">
    </div>

    <h1>Welcome, <?= $_SESSION['user_name']; ?>!</h1>

    <!-- Button to Go to Index Page -->
    <a href="index.php" class="btn">Go to Home</a>

</body>
</html>
