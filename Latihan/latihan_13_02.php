<?php
abstract class User
{
    abstract protected function showName();
    abstract public function showGreeting($greeting);
}

class Admin extends User
{
    public function showName(){
        return "Angga";
    }
    public function showGreeting($greeting, $address = 'Medan'){
        return $greeting . ", nama saya adalah " . $this->showName() . " dari " . $address;
    }
}

$class = new Admin;
echo $class->showGreeting("Selamat Pagi!");
?>
