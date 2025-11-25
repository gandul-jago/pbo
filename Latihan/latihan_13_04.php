<?php
abstract class Mobil {
    abstract public function lihat_spesifikasi($nama_pemilik);
    public static function hidupkan_mobil(){
        echo "Hidupkan Mobil";
    }
}
echo Mobil::hidupkan_mobil();
?>
