<?php

abstract class komputer{
    abstract public function booting_os();
}
interface mouse{
    public function double_klik();
}
class laptop extends komputer implements mouse{
    public function booting_os(){
        return "Proses Booting Sistem Operasi Laptop";
    }
    public function double_klik(){
        return "Double Klik Mouse Laptop";
    }
}
class pc extends komputer implements mouse{
    public function booting_os(){
        return "Proses Booting Sistem Operasi PC";
    }
    public function double_klik(){
        return "Double Klik Mouse PC";
    }
}
class chromebook extends komputer implements mouse{
    public function booting_os(){
        return "Proses Booting Sistem Operasi Chromebook";
    }
    public function double_klik(){
        return "Double Klik Mouse Chromebook";
    }
}


$laptop_baru = new laptop();
$pc_baru = new pc();
$chromebook_baru = new chromebook();

function booting_os_komputer($objek_komputer){
    return $objek_komputer->booting_os();
}

function double_klik_komputer($objek_komputer){
    return $objek_komputer->double_klik();
}


echo booting_os_komputer($laptop_baru);
echo "<br />";
echo double_klik_komputer($laptop_baru);
echo "<br /><br />";

echo booting_os_komputer($pc_baru);
echo "<br />";
echo double_klik_komputer($pc_baru);
echo "<br /><br />";

echo booting_os_komputer($chromebook_baru);
echo "<br />";
echo double_klik_komputer($chromebook_baru);

?>
