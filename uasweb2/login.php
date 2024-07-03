<?php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim = $_POST['nim'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE nim = ?");
    $stmt->execute([$nim]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: input_data.php");
    } else {
        echo "Invalid NIM or password!";
    }
}
?>

<form method="POST">
    NIM: <input type="text" name="nim" required>
    Password: <input type="password" name="password" required>
    <button type="submit">Login</button>
</form>
