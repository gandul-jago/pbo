<?php
interface BangunDatar{
    public function hitungluas();
}
class Persegi implements BangunDatar{
    private $sisi = 4;

    public function __construct($sisi){
        $this->sisi = $sisi;
    }

    public function hitungLuas(){
        return pow($this->sisi,2);
    }
}
class Segitiga implements BangunDatar{
    private $alas;
    private $tinggi;

    public function __construct($alas,$tinggi){
        $this->alas = $alas;
        $this->tinggi = $tinggi;
    }

    public function hitungLuas(){
        return (0.5 * $this->alas * $this->tinggi);
    }
}
class Lingkaran implements BangunDatar{
    private $jariJari = 7;

    public function __construct($jariJari){
        $this->jariJari = $jariJari;
    }

    public function hitungLuas(){
        return (3.14 * pow($this->jariJari,2));
    }
}
$persegi = new Persegi(4);
echo 'Luas Persegi = ' . $persegi->hitungLuas() . "<br>";
$segitiga = new Segitiga(4,5);
echo 'Luas Segitiga = ' . $segitiga->hitungLuas() . "<br>";
$lingkaran = new Lingkaran(7);
echo 'Luas Lingkaran = ' . $lingkaran->hitungLuas() . "<br>";
?>
