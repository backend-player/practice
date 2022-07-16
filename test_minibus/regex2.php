<?php
if(isset($_POST["kirim"])) {
    if(!isset($_POST["angka"])) {
      $pesan = "anda belum mengisi angka";
    } else {
        $angka = $_POST["angka"];
        $pola = '/[0-9]/';
        if(!preg_match($pola, $angka)) {
            $pesan =  "string hanya boleh berupa angka";
        } else {
            $pesan2 = "string merupakan angka";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regular Expression</title>
</head>
<body>
    <form action="" method="POST">
        <label>
            Angka
            <input type="text" name="angka">
        </label>

        <button type="submit" name="kirim">kirim</button>

        <p style="color: red;">
            <?php
              if(isset($pesan)) {
                echo $pesan;
              }
            ?>
        </p>

        <p style="color: green;">
            <?php
              if(isset($pesan2)) {
                echo $pesan2;
              }
            ?>
        </p>
        

    </form>
</body>
</html>