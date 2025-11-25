<?php
interface Kendaraan{
    public function getRoda();
}
interface Motor{
    public function getWarna();
}
class MotorSport implements Motor, Kendaraan{
    public function getWarna(){
        return "Berasal dari method getWarna() di class : MotorSport";
    }
    public function getRoda(){
        return "Berasal dari method " . __METHOD__ . " di class : " . __CLASS__;
    }
}
$motorSport = new MotorSport();
echo $motorSport->getWarna();
echo "<br>";
echo $motorSport->getRoda();
?>
