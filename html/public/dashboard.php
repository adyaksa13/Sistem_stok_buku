<?php
// Menggunakan __DIR__ agar path dijamin akurat 100%
include_once __DIR__ . "/../../php/config/koneksi.php";
require_once __DIR__ . "/../../php/interfaceandmodel/SistemHelper.php";
use function SistemHelper\formatRupiah;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Penjualan Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Manajemen Penjualan Buku</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h3>Daftar Buku & Transaksi</h3>
        
        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahBuku">
            + Tambah Buku
        </button>

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-primary">
                        <tr>
                            <th>Judul Buku</th>
                            <th>Penulis</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th>Aksi Transaksi</th>
                            <th>Kelola Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM buku");
                        while ($row = mysqli_fetch_assoc($query)) {
                        ?>
                        <tr>
                            <td><?php echo $row['judul_buku']; ?></td>
                            <td><?php echo $row['penulis']; ?></td>
                            <td><?php echo $row['stok']; ?></td>
                            <td><?php echo formatRupiah($row['harga']); ?></td>
                            
                            <td>
                                <form action="../../php/controller/proses_transaksi.php" method="POST" class="d-flex">
                                    <input type="hidden" name="id_buku" value="<?php echo $row['id_buku']; ?>">
                                    <input type="number" name="jumlah_beli" class="form-control form-control-sm me-1" placeholder="Qty" required style="width: 70px;">
                                    <select name="status_pembeli" class="form-select form-select-sm me-1" style="width: 100px;">
                                        <option value="Reguler">Reguler</option>
                                        <option value="Member">Member</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary btn-sm">Beli</button>
                                </form>
                            </td>

                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit<?php echo $row['id_buku']; ?>">Edit</button>
                                <a href="../../php/controller/proses_hapus_buku.php?id=<?php echo $row['id_buku']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus buku ini?');">Hapus</a>
                            </td>
                        </tr>

                        <div class="modal fade" id="modalEdit<?php echo $row['id_buku']; ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Data Buku</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="../../php/controller/proses_edit_buku.php" method="POST">
                                        <div class="modal-body">
                                            <input type="hidden" name="id_buku" value="<?php echo $row['id_buku']; ?>">
                                            <div class="mb-3">
                                                <label>Judul Buku</label>
                                                <input type="text" name="judul_buku" class="form-control" value="<?php echo $row['judul_buku']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Penulis</label>
                                                <input type="text" name="penulis" class="form-control" value="<?php echo $row['penulis']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Stok</label>
                                                <input type="number" name="stok" class="form-control" value="<?php echo $row['stok']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Harga</label>
                                                <input type="number" name="harga" class="form-control" value="<?php echo $row['harga']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambahBuku" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Buku Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="../../php/controller/proses_tambah_buku.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Judul Buku</label>
                            <input type="text" name="judul_buku" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Penulis</label>
                            <input type="text" name="penulis" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Stok</label>
                            <input type="number" name="stok" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Harga</label>
                            <input type="number" name="harga" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>