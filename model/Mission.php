<?php

class Mission {

private $_mission;

    public function __construct($mission) {
        $this->setMission($mission);
    }

    public function setMission($mission) {
        $this->_mission = $mission;
    }

    public function getMission() {
        return $this->_mission;
    }

}