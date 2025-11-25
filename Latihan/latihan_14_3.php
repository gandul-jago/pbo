<?php
interface mouse {
    public function klik_kanan();
    public function klik_kiri();
}
interface mouse_gaming extends mouse {
    public function ubah_dpi();
}
class laptop implements mouse_gaming {
    public function klik_kanan(){
        return "Klik Kanan...";
    }
    public function klik_kiri(){
        return "Klik Kiri...";
    }
    public function ubah_dpi(){
        return "Ubah settingan DPI mouse";
    }
}
$laptop_baru = new laptop();
echo $laptop_baru->ubah_dpi();
?>
