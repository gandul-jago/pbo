<?php
class Barang {
    // ... property
    public $nama;
    public $brand;
    public static $harga;

    // ... method
    public static function barang_baru() {
        return "merupakan barang baru dengan kode 101";
    }
}

// set static property
// Catatan: Nama class 'barang' (huruf kecil) tetap terbaca meski definisinya 'Barang' (Huruf besar)
barang::$harga=500000;

// pemanggilan static property dan method
echo "harga barang adalah : Rp" . barang::$harga;
echo "<br>";
echo barang::barang_baru();
?>