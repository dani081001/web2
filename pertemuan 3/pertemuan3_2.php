<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pertemuan 3</title>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $matakuliah = $_POST['matakuliah'];
    $jumlah_kehadiran = $_POST['jumlah_kehadiran'];
    $nilai_tugas = $_POST['nilai_tugas'];
    $uts = $_POST['uts'];
    $uas = $_POST['uas'];

    //ngitung nilai akhir
    $nilai_kehadiran = min($jumlah_kehadiran / 18 * 100, 100) * 0.1;
    $nilai_akhir = $nilai_kehadiran + ($nilai_tugas * 0.2) + ($uts * 0.3) + ($uas * 0.4);

    // Grade
    if ($nilai_akhir >= 80) {
        $grade = "A";
    } elseif ($nilai_akhir >= 70) {
        $grade = "B";
    } elseif ($nilai_akhir >= 60) {
        $grade = "C";
    } elseif ($nilai_akhir >= 50) {
        $grade = "D";
    } else {
        $grade = "E";
    }

    $keterangan = ($nilai_akhir >= 65) ? "Lulus" : "Tidak Lulus";
?>

    <h2>NILAI AKADEMIK</h2>
    <p>Nama Mata Kuliah: <?php echo $matakuliah; ?></p>
    <p>Nama: <?php echo $nama; ?></p>
    <p>NIM: <?php echo $nim; ?></p>
    <p>Jumlah Kehadiran: <?php echo $jumlah_kehadiran; ?></p>
    <p>Nilai Tugas: <?php echo $nilai_tugas; ?></p>
    <p>Nilai UTS: <?php echo $uts; ?></p>
    <p>Nilai UAS: <?php echo $uas; ?></p>
    <p>Grade: <?php echo $grade; ?></p>
    <p>Keterangan: <?php echo $keterangan; ?></p>

<?php
}
?>

<form action="" method="post">
    <label for="nama">Nama:</label><br>
    <input type="text" id="nama" name="nama"><br>
    <label for="nim">NIM:</label><br>
    <input type="text" id="nim" name="nim"><br>
    <label for="matakuliah">Matakuliah:</label><br>
    <input type="text" id="matakuliah" name="matakuliah"><br>
    <label for="jumlah_kehadiran">Jumlah Kehadiran:</label><br>
    <input type="number" id="jumlah_kehadiran" name="jumlah_kehadiran"><br>
    <label for="nilai_tugas">Nilai Tugas:</label><br>
    <input type="number" id="nilai_tugas" name="nilai_tugas"><br>
    <label for="uts">Nilai UTS:</label><br>
    <input type="number" id="uts" name="uts"><br>
    <label for="uas">Nilai UAS:</label><br>
    <input type="number" id="uas" name="uas"><br><br>
    <input type="submit" value="Submit">
</form>

</body>
</html>
