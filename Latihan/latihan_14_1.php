<?php
interface Mobil {
    public function nama_pemilik();
    public function no_kendaraan();
}

class Bus implements Mobil {
    public function nama_pemilik(){
        return "Nama pemilik adalah Master Agus";
    }
}

$bus_data = new Bus();
echo $bus_data->nama_pemilik();
echo "<br>";
echo $bus_data->no_kendaraan();
?>
