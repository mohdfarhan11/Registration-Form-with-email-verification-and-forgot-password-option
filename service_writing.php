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
    <title>Writing Service</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }

        body {
            background: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            padding: 20px;
        }

        nav {
            background: #0072ff;
            width: 100%;
            padding: 15px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
        }

        ul { list-style: none; display: flex; justify-content: center; gap: 20px; }
        ul li { display: inline; }
        ul li a { color: white; text-decoration: none; font-size: 18px; padding: 10px 15px; border-radius: 5px; transition: background 0.3s; }
        ul li a:hover { background: #005bb5; }

        h1 { margin-top: 100px; font-size: 24px; color: #333; }
        p { font-size: 18px; color: #555; text-align: center; margin: 10px 0; }

        .btn {
            margin-top: 20px;
            padding: 12px 20px;
            background: #0072ff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            text-decoration: none;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn:hover { background: #005bb5; }
    </style>
</head>
<body>

    <nav>
        <ul>
            <li><a href="dashboard.php">Home</a></li>
            <li><a href="service_development.php">Development</a></li>
            <li><a href="service_designing.php">Designing</a></li>
        </ul>
    </nav>

    <h1>Writing Service</h1>
    <p>We provide professional content writing, copywriting, and blog writing services.</p>

    <a href="dashboard.php" class="btn">Go Back</a>

</body>
</html>
