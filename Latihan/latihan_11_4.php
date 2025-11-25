<?php
class Lingkaran {
    const PI = '3.14';
}
class Tabung extends Lingkaran {
    public function volume_tabung($jari_jari, $tinggi){
        return "Volume Tabung adalah " . $jari_jari * $jari_jari * $tinggi * self::PI;
    }
}
class Kerucut extends Lingkaran{
    public function volume_kerucut($jari_jari, $tinggi){
        return "Volume Kerucut adalah " . $jari_jari * $jari_jari * 0.33 * $tinggi * self::PI;
    }
}
class Bola extends Lingkaran{
    public function volume_bola($jari_jari){ 
        return "Volume Bola adalah " . $jari_jari * $jari_jari * $jari_jari * 1.33 * self::PI;
    }
}
$tabung = new Tabung();
$kerucut = new Kerucut();
$bola = new Bola();

echo $tabung->volume_tabung(14,10);
echo "<br />";
echo $kerucut->volume_kerucut(14,10);
echo "<br />";
echo $bola->volume_bola(14);
?>