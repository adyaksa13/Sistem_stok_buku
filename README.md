# 📚 Sistem Manajemen Penjualan Buku

Sistem Manajemen Penjualan Buku adalah aplikasi berbasis web yang dibangun menggunakan **PHP Native** dan **MySQL** untuk memudahkan pengelolaan stok buku dan pencatatan transaksi penjualan. Sistem ini menerapkan konsep *Object Oriented Programming* (OOP) dan struktur folder yang rapi (*Separation of Concerns*).

## ✨ Fitur Utama
- **Kelola Master Data Buku (CRUD):** Tambah, Edit, Hapus, dan Tampilkan data buku (Judul, Penulis, Stok, Harga).
- **Transaksi Penjualan:** Pemrosesan pembelian buku yang otomatis memotong stok di *database*.
- **Sistem Diskon Otomatis (OOP):** Implementasi polimorfisme untuk membedakan perhitungan total harga antara pembeli **Reguler** dan **Member** (Member mendapat diskon 10%).
- **User Interface Responsif:** Dibangun menggunakan *framework* **Bootstrap 5** (dilengkapi fitur *Modal* untuk form input).

## 🛠️ Teknologi yang Digunakan
- **Backend:** PHP Native (termasuk OOP & PDO/MySQLi)
- **Database:** MySQL
- **Frontend:** HTML5, CSS3, JavaScript (Vanilla)
- **Library Tambahan:** Bootstrap 5 (via CDN)

## 📂 Struktur Folder
Proyek ini memisahkan antara logika *backend* dan tampilan *frontend* untuk memudahkan pemeliharaan kode:
```text
Sistem_stok_buku/
├── html/
│   └── public/
│       └── dashboard.php           # Antarmuka utama (UI) pengguna
├── php/
│   ├── config/
│   │   └── koneksi.php             # Konfigurasi koneksi ke MySQL
│   ├── controller/
│   │   ├── proses_tambah_buku.php  # Prosedur penambahan buku
│   │   ├── proses_edit_buku.php    # Prosedur pengubahan buku
│   │   ├── proses_hapus_buku.php   # Prosedur penghapusan buku
│   │   └── proses_transaksi.php    # Prosedur kalkulasi transaksi
│   └── interfaceandmodel/
│       ├── SistemHelper.php        # Fungsi bantuan (misal: formatRupiah)
│       └── SistemPenjualan.php     # Class OOP untuk logika transaksi
└── README.md                       # Dokumentasi proyek