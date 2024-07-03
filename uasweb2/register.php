<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim = $_POST['nim'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO users (nim, password) VALUES (?, ?)");
    $stmt->execute([$nim, $password]);

    echo "User registered successfully!";
}
?>

<form method="POST">
    NIM: <input type="text" name="nim" required>
    Password: <input type="password" name="password" required>
    <button type="submit">Register</button>
</form>
