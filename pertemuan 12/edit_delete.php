<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbBerita";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete'])) {
        $idBerita = $_POST['idBerita'];
        $sql = "DELETE FROM tblBerita WHERE idBerita='$idBerita'";
        if ($conn->query($sql) === TRUE) {
            echo "Berita berhasil dihapus";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['edit'])) {
        $idBerita = $_POST['idBerita'];
        $idKategori = $_POST['idKategori'];
        $judulBerita = $_POST['judulBerita'];
        $isiBerita = $_POST['isiBerita'];
        $penulis = $_POST['penulis'];
        $tglDipublish = $_POST['tglDipublish'];
        
        $sql = "UPDATE tblBerita SET idKategori='$idKategori', judulBerita='$judulBerita', isiBerita='$isiBerita', penulis='$penulis', tglDipublish='$tglDipublish' WHERE idBerita='$idBerita'";
        
        if ($conn->query($sql) === TRUE) {
            echo "Berita berhasil diperbarui";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$idBerita = null;
if (isset($_GET['edit_id'])) {
    $idBerita = $_GET['edit_id'];
    $sql = "SELECT * FROM tblBerita WHERE idBerita='$idBerita'";
    $result = $conn->query($sql);
    $editRow = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Berita</title>
</head>
<body>
    <h1>Manage Berita</h1>
    <table border="1">
        <tr>
            <th>Nama Kategori</th>
            <th>Judul Berita</th>
            <th>Isi Berita</th>
            <th>Penulis</th>
            <th>Tanggal Publish</th>
            <th>Aksi</th>
        </tr>
        <?php
        $sql = "SELECT tblBerita.idBerita, tblKategori.nama_kategori, tblBerita.judulBerita, tblBerita.isiBerita, tblBerita.penulis, tblBerita.tglDipublish 
                FROM tblBerita 
                JOIN tblKategori ON tblBerita.idKategori = tblKategori.idKategori
                ORDER BY tblBerita.tglDipublish DESC";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['nama_kategori'] . "</td>";
            echo "<td>" . $row['judulBerita'] . "</td>";
            echo "<td>" . $row['isiBerita'] . "</td>";
            echo "<td>" . $row['penulis'] . "</td>";
            echo "<td>" . $row['tglDipublish'] . "</td>";
            echo "<td>
                    <form style='display:inline;' method='get' action='manage_berita.php'>
                        <input type='hidden' name='edit_id' value='" . $row['idBerita'] . "'>
                        <input type='submit' value='Edit'>
                    </form>
                    <form style='display:inline;' method='post' action='manage_berita.php'>
                        <input type='hidden' name='idBerita' value='" . $row['idBerita'] . "'>
                        <input type='hidden' name='delete' value='true'>
                        <input type='submit' value='Delete'>
                    </form>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>

    <?php if ($idBerita): ?>
    <h2>Edit Berita</h2>
    <form action="manage_berita.php" method="post">
        <input type="hidden" name="idBerita" value="<?php echo $editRow['idBerita']; ?>">
        
        <label for="idKategori">Kategori:</label>
        <select id="idKategori" name="idKategori">
            <?php
            $kategoriResult = $conn->query("SELECT * FROM tblKategori");
            while ($kategoriRow = $kategoriResult->fetch_assoc()) {
                $selected = $kategoriRow['idKategori'] == $editRow['idKategori'] ? 'selected' : '';
                echo "<option value='" . $kategoriRow['idKategori'] . "' $selected>" . $kategoriRow['nama_kategori'] . "</option>";
            }
            ?>
        </select><br>

        <label for="judulBerita">Judul Berita:</label>
        <input type="text" id="judulBerita" name="judulBerita" value="<?php echo $editRow['judulBerita']; ?>" required><br>

        <label for="isiBerita">Isi Berita:</label>
        <textarea id="isiBerita" name="isiBerita" required><?php echo $editRow['isiBerita']; ?></textarea><br>

        <label for="penulis">Penulis:</label>
        <input type="text" id="penulis" name="penulis" value="<?php echo $editRow['penulis']; ?>" required><br>

        <label for="tglDipublish">Tanggal Publish:</label>
        <input type="date" id="tglDipublish" name="tglDipublish" value="<?php echo $editRow['tglDipublish']; ?>" required><br>

        <input type="submit" name="edit" value="Simpan Perubahan">
    </form>
    <?php endif; ?>

    <?php $conn->close(); ?>
</body>
</html>
