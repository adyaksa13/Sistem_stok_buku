<?php
session_start();
include "../config/koneksi.php";

/* Menangkap data dari form edit */
$id_buku    = $_POST['id_buku'];
$judul_buku = $_POST['judul_buku'];
$penulis    = $_POST['penulis'];
$stok       = $_POST['stok'];
$harga      = $_POST['harga'];

/* Query untuk mengubah data di database (Update) */
$query = mysqli_query($conn, "UPDATE buku SET judul_buku='$judul_buku', penulis='$penulis', stok='$stok', harga='$harga' WHERE id_buku='$id_buku'");

if($query) {
    header("Location: ../../html/public/dashboard.php?pesan=edit_sukses");
} else {
    header("Location: ../../html/public/dashboard.php?pesan=edit_gagal");
}
?>