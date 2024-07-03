<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $group_id = $_POST['group_id'];
    $country_id = $_POST['country_id'];
    $menang = $_POST['menang'];
    $seri = $_POST['seri'];
    $kalah = $_POST['kalah'];
    $poin = $_POST['poin'];

    $stmt = $pdo->prepare("UPDATE countries SET menang = ?, seri = ?, kalah = ?, poin = ?, group_id = ? WHERE id = ?");
    $stmt->execute([$menang, $seri, $kalah, $poin, $group_id, $country_id]);

    echo "Data updated successfully!";
}

$groups = $pdo->query("SELECT * FROM groups")->fetchAll();
$countries = $pdo->query("SELECT * FROM countries")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Country Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        select, input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }
        button[type="submit"], button[type="button"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }
        button[type="submit"]:hover, button[type="button"]:hover {
            background-color: #45a049;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>
<body>
    <h2>Update Country Data</h2>

    <form method="POST">
        <label for="group_id">Group:</label>
        <select name="group_id" id="group_id">
            <?php foreach ($groups as $group): ?>
                <option value="<?= $group['id'] ?>"><?= $group['name'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="country_id">Country:</label>
        <select name="country_id" id="country_id">
            <?php foreach ($countries as $country): ?>
                <option value="<?= $country['id'] ?>"><?= $country['name'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="menang">Menang:</label>
        <input type="number" id="menang" name="menang" required>

        <label for="seri">Seri:</label>
        <input type="number" id="seri" name="seri" required>

        <label for="kalah">Kalah:</label>
        <input type="number" id="kalah" name="kalah" required>

        <label for="poin">Poin:</label>
        <input type="number" id="poin" name="poin" required>

        <div class="clearfix">
            <button type="submit">Submit</button>
            <a href="index.php"><button type="button">Back to Index</button></a>
        </div>
    </form>

</body>
</html>
