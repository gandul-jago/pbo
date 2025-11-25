<?php
interface Administrasi{
    public function nomorInduk();
}
class Mahasiswa implements Administrasi{
    protected $prefix = 'MHS';
    public function nomorInduk(){
        return $this->prefix . mt_rand(100, 1000);
    }
}
class Dosen implements Administrasi{
    protected $prefix = 'DSN';
    public function nomorInduk(){
        return $this->prefix . mt_rand(100, 1000);
    }
}
class Karyawan implements Administrasi
{
    protected $prefix = 'KRY';
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
echo "<br>";
echo generateNomorInduk(new Karyawan());
?>
