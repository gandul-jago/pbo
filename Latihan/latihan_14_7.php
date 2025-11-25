<?php

abstract class Administrasi
{
    private $name;
    public function setName($name) {
        $this->name = $name;
    }
    abstract public function nomorInduk();
}
class Mahasiswa extends Administrasi{
    protected $prefix = 'MHS';
    public function nomorInduk(){
        return $this->prefix . mt_rand(100, 1000);
    }
}
class Dosen extends Administrasi{
    protected $prefix = 'DSN';
    public function nomorInduk(){
        return $this->prefix . mt_rand(100, 1000);
    }
}
function generateNomorInduk(Administrasi $adm) {
    return $adm->nomorInduk();
}
echo generateNomorInduk(new Mahasiswa());
echo "<br>";
echo generateNomorInduk(new Dosen());
?>
