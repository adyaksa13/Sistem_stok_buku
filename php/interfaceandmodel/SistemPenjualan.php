<?php
namespace SistemPenjualan; 


interface KalkulasiTransaksi
{
    public function hitungTotal();
}


class TransaksiUtama
{
    protected $harga_buku;
    protected $jumlah_beli;

    public function __construct($harga_buku = 0, $jumlah_beli = 0)
    {
        $this->harga_buku = $harga_buku;
        $this->jumlah_beli = $jumlah_beli;
    }

       public function setDetailTransaksi($harga_buku, $jumlah_beli = 1)
    {
        $this->harga_buku = $harga_buku;
        $this->jumlah_beli = $jumlah_beli;
    }
}


class TransaksiReguler extends TransaksiUtama implements KalkulasiTransaksi
{
    public function hitungTotal()
    {
        return $this->harga_buku * $this->jumlah_beli;
    }
}

class TransaksiMember extends TransaksiUtama implements KalkulasiTransaksi
{
    public function hitungTotal()
    {
        /* Member mendapat diskon 10% */
        $total = $this->harga_buku * $this->jumlah_beli;
        return $total - ($total * 0.10); 
    }
}
?>