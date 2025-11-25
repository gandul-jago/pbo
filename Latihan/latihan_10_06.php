<?php

include 'latihan_10_05.php';
class Mahasiswa extends Login {
    public static $kelas;
    public static $jurusan;
    public static $fakultas;

    public static function data_mahasiswa(){
        return "Kelas Anda adalah:" . self::$kelas;
    }

    public static function tampilkan(){
        echo parent::user(); 
        echo "<br />";
        echo self::data_mahasiswa();
    }
}
Mahasiswa::$kelas = "TI Malam A";
Mahasiswa::tampilkan();
?>