<?php
$nama_negara = $_POST['nama_negara'];
$jumlah_pertandingan = $_POST['jumlah_pertandingan'];
$jumlah_menang = $_POST['jumlah_menang'];
$jumlah_seri = $_POST['jumlah_seri'];
$jumlah_kalah = $_POST['jumlah_kalah'];
$jumlah_poin = $_POST['jumlah_poin'];
$nama_operator = $_POST['nama_operator'];
$nim = $_POST['nim'];

$data = "<tr>
            <td>$nama_negara</td>
            <td>$jumlah_pertandingan</td>
            <td>$jumlah_menang</td>
            <td>$jumlah_seri</td>
            <td>$jumlah_kalah</td>
            <td>$jumlah_poin</td>
        </tr>";

$file_content = file_get_contents("db.html");

$file_content = str_replace("</table>", $data."</table>", $file_content);
file_put_contents("db.html", $file_content);

if(strpos($file_content, "</p1>") !== "$nama_operator" && strpos($file_content, "</p2>") !== "$nim") {

$file_content = str_replace("</p1>", $nama_operator."</p1>", $file_content);
file_put_contents("db.html", $file_content);

$file_content = str_replace("</p2>", $nim."</p2>", $file_content);
file_put_contents("db.html", $file_content);
}

echo "Data berhasil disimpan.";
?>
