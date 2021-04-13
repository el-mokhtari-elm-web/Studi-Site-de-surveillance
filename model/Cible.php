<?php

class Cible {

private $_cible;

    public function __construct($cible) {
        $this->setCible($cible);
    }

    public function setCible($cible) {
        $this->_cible = $cible;
    }

    public function getCible() {
        return $this->_cible;
    }

}