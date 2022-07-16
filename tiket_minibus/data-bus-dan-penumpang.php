<?php
include 'connection.php';
include 'navbar.php';


$sql = "SELECT * FROM data_penumpang";
$result = mysqli_query($conn, $sql);

if(isset($_POST["cari"])) {
    $keyword = htmlspecialchars($_POST["keyword"]);

    if(empty($keyword)) {
        $pesan_error = "anda belum mengisi pencarian";
    } else {
        $sql = "SELECT * FROM data_penumpang WHERE nama LIKE '%$keyword%' OR nomor_hp LIKE '%$keyword%' OR email LIKE '%$keyword%' ";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) == 0) {
            $pesan_error = "data tidak ditemukan";
            $hide_table = "display:none";
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
    <title>Data bus dan penumpang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Data bus dan penumpang</h2>

        
    <div class="wrapper-tabel">

        <div class="wrapper-pencarian">
            <form action="" method="POST">
                <input type="text" name="keyword" placeholder="Masukkan kata pencarian">
                <button type="submit" name="cari">Cari</button>

                <p>
                    <?php
                      if(isset($pesan_error)) {
                        echo $pesan_error;
                      }
                    ?>
                </p>

            </form>
        </div>
        

        <table style=" <?php echo $hide_table ?> ">
            <tr>
                <th>Nama</th>
                <th>Nomor HP</th>
                <th>Email</th>
                <th>Jenis kelamin</th>
                <th>Bus</th>
                <th>Kursi</th>
                <th>Tanggal berangkat</th>
                <th>Tanggal booking</th>
                <th>Status pembayaran</th>
                <th>Kode pembayaran</th>
            </tr>

            <?php
            while($row = mysqli_fetch_assoc($result)) : ?>

            <?php  
                $nama = $row["nama"];
                $nomor_hp = $row["nomor_hp"];
                $email = $row["email"];
                $jenis_kelamin = $row["jenis_kelamin"];
                $bus = $row["bus"];
                $kursi = $row["kursi"];
                $tanggal_berangkat = $row["tanggal_berangkat"];
                $tanggal_booking = $row["tanggal_booking"];
                $status_pembayaran = $row["status_pembayaran"];
                $kode_pembayaran = $row["kode_pembayaran"];
            ?>

            <tr>
                <td><?php echo $nama ?></td>
                <td><?php echo $nomor_hp ?></td>
                <td><?php echo $email ?></td>
                <td><?php echo $jenis_kelamin ?></td>
                <td><?php echo $bus ?></td>
                <td><?php echo $kursi ?></td>
                <td><?php echo $tanggal_berangkat ?></td>
                <td><?php echo $tanggal_booking ?></td>
                <td><?php echo $status_pembayaran ?></td>
                <td><?php echo $kode_pembayaran ?></td>

            </tr>

            <?php endwhile ?>





        </table>
    </div>
</body>
</html>