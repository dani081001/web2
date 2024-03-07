<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pertemuan 2</title>
</head>
<body>
    <h1>Latihan 1</h1>
    <form action="" method="post">
        <label for="nama">Nama : </label>
        <input type="text" name="nama"> </br>
        <label for="jurusan">Jurusan : </label>
        <input type="text" name="jurusan"> </br>
        <label for="tugas">Tugas : </label>
        <input type="text" name="tugas"> </br>
        <label for="uts">UTS : </label>
        <input type="text" name="uts"> </br>
        <label for="uas">UAS : </label>
        <input type="text" name="uas"> </br>
        <input type="submit" value="Hitung">
    </form>

    <br>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $nama = $_POST['nama'];
            $jurusan = $_POST['jurusan'];
            $tugas = $_POST['tugas'];
            $uts = $_POST['uts'];
            $uas = $_POST['uas'];
    
            $avg = ($tugas + $uts + $uas) / 3;

            echo "Nama : $nama </br>";
            echo "Jurusan : $jurusan </br>";
            echo "Nilai Tugas : $tugas </br>";
            echo "Nilai UTS : $uts </br>";
            echo "Nilai UAS : $uas </br>";
            echo "Rata-rata : " . round($avg);
        }
    ?>
</body>
</html>