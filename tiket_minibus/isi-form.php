<?php
include 'connection.php';
include 'navbar.php';

session_start();

// cek apakah penumpang sudah mengisi form sebelumnya
if(!isset($_SESSION["nomor_kursi"])) {
    header("Location:index.php");
}

if(isset($_POST["submit"])) {
    // setelah pilih kursi, isi form data diri penumpang
    $nama = htmlspecialchars($_POST["nama"]);
    $nomor_hp = htmlspecialchars($_POST["nomor_hp"]);
    $email = htmlspecialchars($_POST["email"]);
    $jenis_kelamin = htmlspecialchars($_POST["jenis_kelamin"]);
    $nomor_bus = "bus-1";
    $nomor_kursi = $_SESSION["nomor_kursi"];
    $tanggal_berangkat = $_SESSION["tanggal_berangkat"];
    $status_pembayaran = "menunggu";
    $kode_pembayaran = substr(md5(mt_rand()), 0, 10);

    $timezone = time() + (60 * 60 * 7);
    $tanggal_booking = gmdate("Y/m/d H:i:sa", $timezone);
    
    // cek apakah form sudah diisi semua
    if( empty($nama) || empty($nomor_hp) || empty($email) || empty($jenis_kelamin) ) {
        $notifikasi_gagal = "anda belum mengisi semua form";
    } else if (!preg_match('/^[a-zA-Z\s]+$/', $nama)) {
        $notifikasi_gagal = "nama harus berupa huruf";
    } else if (!ctype_digit($nomor_hp)) {
        $notifikasi_gagal = "nomor HP harus berupa angka";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $notifikasi_gagal = "format email salah";
    } else {
        $sql = "INSERT INTO data_penumpang (nama, nomor_hp, email, jenis_kelamin, bus, kursi, tanggal_berangkat, tanggal_booking, status_pembayaran, kode_pembayaran) 
        VALUE ('$nama', '$nomor_hp', '$email', '$jenis_kelamin', '$nomor_bus', '$nomor_kursi', '$tanggal_berangkat', '$tanggal_booking', '$status_pembayaran', '$kode_pembayaran')";

        if(mysqli_query($conn, $sql)) {
            $notifikasi_berhasil = "Tiket berhasil dipesan. Kode pembayaran : " . $kode_pembayaran . ". Kode pembayaran telah dikirimkan ke email anda. Batas waktu pembayaran : 1 jam";
            session_unset();
            session_destroy();
            $selesai = "ya";
        } else {
            $notifikasi_gagal = "Tiket gagal dipesan";
            // die();
        }

    };
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
    <h2>Isi form data penumpang</h2>
    <div class="form">
        <form action="" method="POST">
            <label>
                Nama
                <input type="text" name="nama" required value="<?php if(isset($nama)) { echo $nama; } ?>">
            </label>
    
            <label>
                Nomor HP
                <input type="text" name="nomor_hp" required value="<?php if(isset($nomor_hp)) { echo $nomor_hp; } ?>">
            </label>
    
            <label>
                Email
                <input type="text" name="email" required value="<?php if(isset($email)) { echo $email; } ?>">
            </label>
    
            <label>
                Jenis Kelamin : 
                <input type="radio" name="jenis_kelamin" id="laki_laki" value="laki-laki" required <?php if(isset($_POST["jenis_kelamin"]) && $_POST["jenis_kelamin"] == "laki-laki") { echo "checked"; }  ?>>
                <label for="laki_laki">Laki-laki</label>
                <input type="radio" name="jenis_kelamin" id="perempuan" value="perempuan" required <?php if(isset($_POST["jenis_kelamin"]) && $_POST["jenis_kelamin"] == "perempuan") { echo "checked"; }  ?>>
                <label for="perempuan">Perempuan</label>
            </label>

            <p class="teks-hijau"><?php if(isset($notifikasi_berhasil)) { echo $notifikasi_berhasil; }; ?></p>
            <p class="teks-merah"><?php if(isset($notifikasi_gagal)) { echo $notifikasi_gagal; }; ?></p>

            <?php if(empty($selesai)): ?>
            <button type="submit" name="submit">Kirim</button>
            <?php endif ?>
            
        </form>
    </div>
</body>
</html>