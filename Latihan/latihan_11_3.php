<?php
// buat class persegi
class Persegi {
    // buat konstanta class persegi
    const SISI = '4';
}

class Kubus extends Persegi {
    const SISI = '12';
    public function hitung_persegi($panjang){
        return "Keliling persegi adalah " . $panjang * parent::SISI;
    }
    public function hitung_kubus($panjang){
        return "Keliling kubus adalah " . $panjang * self::SISI;
    }
}

$keliling = new Kubus();

echo $keliling->hitung_persegi(4);
echo "<br />";
echo $keliling->hitung_kubus(4);
?>