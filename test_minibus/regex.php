<?php
if(isset($_POST["kirim"])) {
    if(empty($_POST["huruf"])) {
      $pesan = "anda belum mengisi huruf";
    } else {
        $huruf = $_POST["huruf"];
        $pola = '/[a-z A-Z]/';
        if(!preg_match($pola, $huruf)) {
            $pesan =  "string hanya boleh berupa huruf";
        } else {
            $pesan2 = "string merupakan huruf";
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
            Huruf (alfabet latin)
            <input type="text" name="huruf">
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