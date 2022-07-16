<?php
include 'connection.php';
include 'navbar.php';

session_start();

// cek apakah penumpang sudah mengisi form sebelumnya
if(!isset($_SESSION["tanggal_berangkat"])) {
    header("Location:index.php");
    // die();
} else {
    // var_dump($_SESSION["tanggal_berangkat"]);
    $tanggal_berangkat = $_SESSION["tanggal_berangkat"];
}

if(isset($_POST["submit"])) {
    $nomor_kursi = $_POST["nomor_kursi"];
    if(empty($nomor_kursi)) {
        $notifikasi_gagal = "Pilih kursi terlebih dahulu";
    } else {
        $_SESSION["nomor_kursi"] = $nomor_kursi;
        header("Location:isi-form.php");
    }
}


$sql = "SELECT kursi FROM data_penumpang WHERE tanggal_berangkat = '$tanggal_berangkat' ";

$result = mysqli_query($conn, $sql);


$jumlah_kursi_terisi = mysqli_num_rows($result);
// echo $jumlah_kursi_terisi;

// jika kursi terisi masih 0
if ($jumlah_kursi_terisi == 0) {
    $array_kursi_tersedia = array(1, 2, 3, 4, 5, 6, 7, 8);
} else if( $jumlah_kursi_terisi > 0 ) {
    // jika kursi terisi lebih dari 0
    // lakukan perulangan untuk memasukkan nomor kursi yang terisi ke sebuah array
    $array_kursi_terisi = array();

    while($row = mysqli_fetch_assoc($result)) {
        // echo $row["kursi"];
        array_push($array_kursi_terisi, $row["kursi"]);
        // print_r($array_kursi);
    }
    // echo count($array_kursi);

    for($i=0; $i < count($array_kursi_terisi); $i++) {
        // echo $array_kursi[$i];
    }

    // filter kursi yang tersedia
    $array_kursi_lengkap = array(1, 2, 3, 4, 5, 6, 7, 8);
    $array_kursi_tersedia = array_values( array_diff($array_kursi_lengkap, $array_kursi_terisi) );

}

// var_dump($array_kursi_terisi);
// echo "<br>";
// var_dump($array_kursi_tersedia);
// var_dump($array_kursi_tersedia[2]);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan tiket</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Pilih kursi</h2>
    <div class="form">
        <form action="" method="POST">
            <label>
                Nomor kursi
                <select name="nomor_kursi">
                    <option value="">Pilih nomor kursi</option>
                    <?php for($i = 0; $i < count($array_kursi_tersedia); $i++) : ?>
                        
                        <option value=<?php echo $array_kursi_tersedia[$i] ?>><?php echo $array_kursi_tersedia[$i] ?></option>

                    <?php endfor ?>
                </select>
            </label>

            <p class="teks-hijau"><?php if(isset($notifikasi_berhasil)) { echo $notifikasi_berhasil; }; ?></p>
            <p class="teks-merah"><?php if(isset($notifikasi_gagal)) { echo $notifikasi_gagal; }; ?></p>

            
            <button type="submit" name="submit">Kirim</button>
            
        </form>
    </div>

    <div class="denah-kursi">
        <img src="hiace-8.png" alt="">
    </div>
</body>
</html>