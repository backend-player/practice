<?php
// jumlah kursi = 8 
$kursi_lengkap = array(1, 2, 3, 4, 5, 6, 7, 8);
$kursi_terisi = array(1, 2, 4);

// menghapus kursi yang sama antara dua array (belum reset indeks)
$kursi_tersedia = array_diff($kursi_lengkap, $kursi_terisi);

// tampilkan isi array dari $kursi_tersedia
// for($i = 0; $i < count($kursi_tersedia); $i++) {
//     // echo $i;
//     echo $kursi_tersedia[$i];
//     echo "<br>";
// }



// array baru dengan indeks dimulai dari 0
$kursi_tersedia_baru = array_values($kursi_tersedia);

// // tampilkan isi array $kursi_tersedia_baru
// for($i = 0; $i < count($kursi_tersedia_baru); $i++) {
//     // echo $i;
//         echo $kursi_tersedia_baru[$i];
//         echo "<br>";
// }

// echo count($kursi_tersedia);

var_dump($kursi_tersedia);
echo "<br>";
var_dump($kursi_tersedia_baru);


// contoh : jika nomor kursi adalah 1 / 2 / 4, jangan tampilkan nomor kursi tersebut (solusi manual)
// for($i = 1; $i <= 8; $i++) {
//     if($i == 1 || $i == 2 || $i == 4) {
//         continue;
//     }
//     echo $i;
// }


?>