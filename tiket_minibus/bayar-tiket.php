<?php
include 'connection.php';
include 'navbar.php';


if(isset($_POST["submit"])) {
    $bayar_tiket = htmlspecialchars($_POST["bayar"]);
    
    if(empty($bayar_tiket)) {
        $notifikasi_gagal = "anda belum mengisi form";
    } else {
        $sql = "SELECT status_pembayaran, kode_pembayaran FROM data_penumpang WHERE kode_pembayaran = '$bayar_tiket' ";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) == 0) {
            $notifikasi_gagal = "kode pembayaran salah";
        } else if( mysqli_num_rows($result) > 0 ) {
            // pilih data, tampung variabel
            while($row = mysqli_fetch_assoc($result)) {
                $db_status_pembayaran = $row["status_pembayaran"];
                $db_kode_pembayaran = $row["kode_pembayaran"];
            }

            if($db_status_pembayaran == "batal") {
                $notifikasi_gagal = "kode pembayaran sudah kadaluarsa";
            } else if($db_status_pembayaran == "berhasil") {
                $notifikasi_gagal = "anda sudah melakukan pembayaran";
            } else {
                $sql2 = "UPDATE data_penumpang SET status_pembayaran = 'berhasil' WHERE kode_pembayaran = '$bayar_tiket' ";
                $result = mysqli_query($conn, $sql2);
                $notifikasi_berhasil = "pembayaran berhasil";
            }
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
    <title>Bayar tiket</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Bayar tiket</h2>
        <div class="form">
            <form action="" method="POST">
                <label>
                    Kode pembayaran
                    <input type="text" name="bayar">
                </label>

                <p class="teks-hijau"><?php if(isset($notifikasi_berhasil)) { echo $notifikasi_berhasil; }; ?></p>
                <p class="teks-merah"><?php if(isset($notifikasi_gagal)) { echo $notifikasi_gagal; }; ?></p>

                <button type="submit" name="submit">bayar</button>
            </form>
        </div>
</body>
</html>