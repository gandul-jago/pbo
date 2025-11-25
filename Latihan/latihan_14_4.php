<?php
interface Kendaraan{
    public function __construct();
    public function getWarna();
}
class Motor implements Kendaraan{
    public function __construct(){
        echo "Halo ini dari konstruktor Motor<br>";
    }
    public function getWarna(){
        return "Hijau";
    }
}
class Mobil implements Kendaraan{
    public function __construct(){
        echo "Halo ini dari konstruktor Mobil<br>";
    }
    public function getWarna(){
        return "Biru";
    }
}
$motor = new Motor();
echo $motor->getWarna();
echo "<br>";
$mobil = new Mobil();
echo $mobil->getWarna();
?>
