<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Ambil data dari database
$stmt = $pdo->query("SELECT c.name AS country, g.name AS group_name, c.menang, c.seri, c.kalah, c.poin FROM countries c LEFT JOIN groups g ON c.group_id = g.id");
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Periksa apakah data tersedia sebelum digunakan
if (empty($data)) {
    echo "No data available.";
} else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UEFA 2024 Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }
        h2 {
            text-align: center;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .datetime {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h2>Data Negara UEFA 2024</h2>
    <div class="datetime">
        <p>Data Group B</p>
        <p>Per <?= date('d/m/Y H:i:s') ?></p>
        <p>211011401955</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>Tim</th>
                <th>Grup</th>
                <th>Menang</th>
                <th>Seri</th>
                <th>Kalah</th>
                <th>Poin</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $row): ?>
                <tr>
                    <td><?= $row['country'] ?></td>
                    <td><?= $row['group_name'] ?></td>
                    <td><?= $row['menang'] ?></td>
                    <td><?= $row['seri'] ?></td>
                    <td><?= $row['kalah'] ?></td>
                    <td><?= $row['poin'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="generate_pdf.php" target="_blank">Download PDF</a>
</body>
</html>

<?php
}
?>
