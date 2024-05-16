<?php
// insert_berita.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbBerita";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idKategori = $_POST['idKategori'];
    $judulBerita = $_POST['judulBerita'];
    $isiBerita = $_POST['isiBerita'];
    $penulis = $_POST['penulis'];
    $tglDipublish = $_POST['tglDipublish'];
    
    $sql = "INSERT INTO tblBerita (idKategori, judulBerita, isiBerita, penulis, tglDipublish)
            VALUES ('$idKategori', '$judulBerita', '$isiBerita', '$penulis', '$tglDipublish')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Berita berhasil ditambahkan";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
