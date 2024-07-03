<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UEFA 2024</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            margin-top: 50px;
            color: #333;
        }
        nav {
            text-align: center;
            margin-top: 20px;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
        }
        nav ul li {
            display: inline-block;
            margin-right: 20px;
        }
        nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            font-size: 18px;
            padding: 10px;
            border-radius: 5px;
            background-color: #e0e0e0;
            transition: background-color 0.3s ease;
        }
        nav ul li a:hover {
            background-color: #ccc;
        }
    </style>
</head>
<body>
    <h1>Welcome to UEFA 2024</h1>
    <nav>
        <ul>
            <li><a href="input_data.php">Input Data</a></li>
            <li><a href="view_data.php">View Data</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</body>
</html>
