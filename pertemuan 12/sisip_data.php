<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pertemuan12web2";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query SQL untuk menyisipkan data
$sql = "INSERT INTO users (username, email) VALUES ('john_doe', 'john@example.com')";

if (mysqli_query($conn, $sql)) {
    echo "Data berhasil disisipkan";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Menutup koneksi
$conn->close();
?>
