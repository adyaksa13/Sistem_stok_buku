<?php
session_start();
include "../config/koneksi.php";
require "../interfaceandmodel/SistemPenjualan.php";
include_once __DIR__ . "/../config/koneksi.php";
require_once __DIR__ . "/../interfaceandmodel/SistemPenjualan.php";

use SistemPenjualan\TransaksiReguler;
use SistemPenjualan\TransaksiMember;


$id_buku = $_POST['id_buku'];
$jumlah_beli = $_POST['jumlah_beli'];
$status_pembeli = $_POST['status_pembeli'];


$query_buku = mysqli_query($conn, "SELECT harga, stok FROM buku WHERE id_buku='$id_buku'");
$data_buku = mysqli_fetch_assoc($query_buku); // Penerapan Array

$harga = $data_buku['harga'];
$stok_sekarang = $data_buku['stok'];


if ($stok_sekarang >= $jumlah_beli) {
    

    if ($status_pembeli == "Member") {
        $transaksi = new TransaksiMember();
    } else {
        $transaksi = new TransaksiReguler();
    }

    $transaksi->setDetailTransaksi($harga, $jumlah_beli);
    $total_bayar = $transaksi->hitungTotal();


    mysqli_query($conn, "INSERT INTO penjualan (id_buku, jumlah_beli, total_harga, status_pembeli) VALUES ('$id_buku', '$jumlah_beli', '$total_bayar', '$status_pembeli')");
    

    $stok_baru = $stok_sekarang - $jumlah_beli;
    mysqli_query($conn, "UPDATE buku SET stok='$stok_baru' WHERE id_buku='$id_buku'");

    header("Location: ../../html/public/dashboard.php?pesan=sukses");
} else {
    header("Location: ../../html/public/dashboard.php?pesan=stok_kurang");
}
?>