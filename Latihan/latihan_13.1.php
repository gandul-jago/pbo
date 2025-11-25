<?php

abstract class Mobil {
    abstract public function lihat_spesifikasi();
}

class Bus extends Mobil {
    public function lihat_spesifikasi() {
        return "Lihat Spesifikasi Mobil ...";
    }
    public function hidupkan_mobil() {
        echo "Hidupkan Mobil";
    }
}

$bus_baru = new Bus();
echo $bus_baru->lihat_spesifikasi();
echo "<br />";
echo $bus_baru->hidupkan_mobil();
?>
