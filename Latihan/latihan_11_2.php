<?php
// buat class Lingkaran
class Lingkaran {

    // buat konstanta
    const PI = '3.14';

    // buat method
    public function hitung_luas($jari_jari) {
        // Perhatikan cara panggil konstanta di dalam method menggunakan 'self::PI'
        return "Luas lingkaran adalah " . $jari_jari * $jari_jari * self::PI;
    }
}

// buat objek dari class Lingkaran (instansiasi)
$luas_lingkaran = new Lingkaran();

// Hitung dengan jari-jari 10
echo $luas_lingkaran->hitung_luas(10);

?>