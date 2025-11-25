<?php

class Barang {

    protected static function beli_barang(){
        return "Beli Barang Baru";
    }
}

// turunkan class barang ke class record
class Record extends Barang{
    private static function beli_soundcard(){
        return "Beli Sound Card Baru";
    }
    public static function beli_semua(){
        echo parent::beli_barang();
        echo "<br />";
        echo self::beli_soundcard();
    }
}
Record::beli_semua();

?>