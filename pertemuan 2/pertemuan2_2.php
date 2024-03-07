
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pertemuan 2</title>
</head>
<body>
    <h1>Latihan 2</h1>
    <center>

        <form action="" method="post">
            <input type="text" name="nilai1" placeholder="Nilai 1">
            <select name="operator" id="operator">
                <option value="+">+</option>
                <option value="-">-</option>
                <option value="*">*</option>
                <option value="/">/</option>
            </select>
            <input type="text" name="nilai2" placeholder="Nilai 2">
            <input type="submit" value="Submit">
        </form>
        </br>
    </center>

    <?php   
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $nilai1 = $_POST['nilai1'];
        $nilai2 = $_POST['nilai2'];
        $operator = $_POST['operator'];
    
        if($operator == "+") {
            $hasil = $nilai1 + $nilai2;
        } else if($operator == "-") {
            $hasil = $nilai1 - $nilai2;
        } else if($operator == "*") {
            $hasil = $nilai1 * $nilai2;
        } else if($operator == "/") {
            $hasil = $nilai1 / $nilai2;
        }
        echo "<center><font size='5'>Hasil : $hasil</font></center>";
    }
?>
</body>
</html>