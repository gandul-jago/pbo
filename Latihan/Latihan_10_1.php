<?php

// buat class mahasiswa
class mahasiswa {
    // ... property dari class mahasiswa
    public static $nama;
    public static $nim;
    public static $jurusan;

    // ... Method dari class mahasiswa
    public static function mahasiswa_baru() {
        return "merupakan mahasiswa baru dengan nama Budi";
    }
}

// set static property
mahasiswa::$nim=20100298;

// pemanggilan static property dan method
echo mahasiswa::$nim;
echo "<br>";
echo mahasiswa::mahasiswa_baru();

?>