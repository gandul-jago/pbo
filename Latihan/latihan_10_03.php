<?php

// buat class barang
class Barang {
    // ... property
    public $nama;
    public $brand;
    public static $harga;

    // ... method
    public static function barang_baru() {
        // Perhatikan penggunaan "self::$harga" untuk mengambil nilai static di dalam class sendiri
        return "Sound Card V8 merupakan barang baru dengan kode 101 dengan harga barang adalah: Rp" . self::$harga;
    }
}

// set static property
barang::$harga = 500000;

// pemanggilan static property dan method
echo "<br>";
echo barang::barang_baru();

?>