<?php

class Mamalia {

    public function tempat_hidup() {
        return "Hampir seluruh mamalia hidup di darat,";
    }
}

class Paus extends Mamalia {

    public function tempat_hidup() {
        return "Paus hidup di air";
    }
}

$hewan_baru = new Paus();
echo $hewan_baru->tempat_hidup();

?>