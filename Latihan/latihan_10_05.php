<?php
// buat class Login
class Login {

    public static $nama;
    public static $nim;
    protected static $username;
    protected static $password;

    // protected static method
    protected static function user(){
        // Menggunakan self:: untuk akses properti di class yang sama
        return "Selamat datang," . self::$nama;
    }
}

// Mengisi data nama langsung di file ini
Login::$nama = "Amir Saleh";
?>