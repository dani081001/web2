<?php
// insert_kategori.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbBerita";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_kategori = $_POST['nama_kategori'];
    $sql = "INSERT INTO tblKategori (nama_kategori) VALUES ('$nama_kategori')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Kategori berhasil ditambahkan";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
