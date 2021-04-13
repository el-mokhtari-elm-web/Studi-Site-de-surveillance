<?php

class Planque {

private $_planque;

    public function __construct($planque) {
        $this->setPlanque($planque);
    }

    public function setPlanque($planque) {
        $this->_planque = $planque;
    }

    public function getPlanque() {
        return $this->_planque;
    }

}