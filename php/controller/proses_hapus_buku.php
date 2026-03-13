<?php
session_start();
include "../config/koneksi.php";

$id_buku = $_GET['id'];

$query = mysqli_query($conn, "DELETE FROM buku WHERE id_buku='$id_buku'");

if($query) {
    header("Location: ../../html/public/dashboard.php?pesan=hapus_sukses");
} else {
    header("Location: ../../html/public/dashboard.php?pesan=hapus_gagal");
}
?>