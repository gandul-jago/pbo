<?php
// buat class Mobil
class Mobil {
    // buat konstanta
    const TYPE = 'Sedan';
}
// panggil konstanta class
echo "Kebanyakan taxi menggunakan mobil " .Mobil::TYPE;
// hasil: Kebanyakan taxi menggunakan mobil Sedan
?>

<?php
// buat class Mobil
class Mobil {
    // buat konstanta
    const TYPE = 'Sedan';
}
// buat objek dari class Mobil (instansiasi)
$mobil_taxi = new Mobil();
// panggil konstanta class
echo "Kebanyakan taxi menggunakan mobil " .$mobil_taxi::TYPE;
// hasil: Kebanyakan taxi menggunakan mobil Sedan


?><?php
// buat class Mobil
class Mobil {
    // buat konstanta
    const TYPE = 'Sedan';
}
// buat variabel dengan nama class
$nama = "Mobil";
// panggil konstanta class
echo "Kebanyakan taxi menggunakan mobil " .$nama::TYPE;
// hasil: Kebanyakan taxi menggunakan mobil Sedan
?>