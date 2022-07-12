<?php
include 'connection.php';
include 'navbar.php';

session_start();

$tanggal_minimal = date("Y-m-d");
$tanggal_maksimal = date("Y-m-d", strtotime("+1 year"));
// var_dump($tanggal_maksimal);


// jika tombol kirim ditekan
if(isset($_POST["submit"])) {
    // cek apakah tanggal yang dipilih tersedia
    $tanggal_berangkat = $_POST["tanggal_berangkat"];

    $sql = "SELECT * FROM data_penumpang WHERE tanggal_booking = '$tanggal_berangkat' && status_pembayaran != 'batal' ";
    // $sql = "SELECT * FROM data_penumpang";
    $result = mysqli_query($conn, $sql);
    $jumlah_penumpang = mysqli_num_rows($result);

    // jika tanggal belum diisi
    if(empty($tanggal_berangkat)) {
        $notifikasi_gagal = "anda belum memilih tanggal";
    } else if($jumlah_penumpang >= 8) {
    // jika jumlah penumpang >= 8, tampilkan pesan bahwa bus penuh, jika tersedia, lanjutkan ke form selanjutnya (pilih kursi)
        $notifikasi_gagal = "mohon maaf, kursi penuh";
    } else {
        $_SESSION["tanggal_berangkat"] = $tanggal_berangkat;
        header("Location:pilih-kursi.php");
    }

    // var_dump($jumlah_penumpang);


    

}
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
    <h2>Pesan tiket</h2>
    <div class="form">
        <form action="" method="POST">
            <label>
                Tanggal berangkat
                <input type="date" name="tanggal_berangkat" min= <?php echo $tanggal_minimal ?> max= <?php echo $tanggal_maksimal ?>>
            </label>

            <p class="teks-merah"><?php if(isset($notifikasi_gagal)) { echo $notifikasi_gagal; }; ?></p>

            <button type="submit" name="submit">Kirim</button>
            
        </form>
    </div>

    
</body>
</html>