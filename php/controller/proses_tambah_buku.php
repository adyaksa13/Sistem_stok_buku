<?php
session_start();

include __DIR__ . "/../config/koneksi.php";


$judul_buku = $_POST['judul_buku'];
$penulis    = $_POST['penulis'];
$stok       = $_POST['stok'];
$harga      = $_POST['harga'];


$query = mysqli_query($conn, "INSERT INTO buku (judul_buku, penulis, stok, harga) VALUES ('$judul_buku', '$penulis', '$stok', '$harga')");

/* Pengecekan sukses atau gagal */
if($query) {
    header("Location: ../../html/public/dashboard.php?pesan=tambah_sukses");
} else {
    // Jika gagal, ini akan menampilkan pesan error dari MySQL agar kita tahu salahnya di mana
    echo "Gagal Menambahkan Data! Error: " . mysqli_error($conn);
    // header("Location: ../../html/public/dashboard.php?pesan=tambah_gagal");
}
?>