<?php
interface Mobil {
    public function nama_pemilik();
    private function no_kendaraan();
    public function warna_kendaraan();
    public function kapasitas_penumpang();
}
class Bus implements Mobil {
    public function nama_pemilik(){
        return "Nama pemilik adalah Master Agus";
    }
    public function no_kendaraan(){
        return "Nomor kendaraan adalah BK 0010 XX";
    }
    public function warna_kendaraan(){
        return "Warna kendaraan adalah hijau";
    }
    public function kapasitas_penumpang(){
        return "Jumlah penumpang adalah 30 orang";
    }
}
$bus_data = new Bus();
echo $bus_data->nama_pemilik();
echo "<br>";
echo $bus_data->no_kendaraan();
echo "<br>";
echo $bus_data->warna_kendaraan();
echo "<br>";
echo $bus_data->kapasitas_penumpang();
?>
