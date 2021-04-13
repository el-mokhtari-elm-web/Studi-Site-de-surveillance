<?php

class Agent {

private $_agent;

    public function __construct($agent) {
        $this->setAgent($agent);
    }

    public function setAgent($agent) {
        $this->_agent = $agent;
    }

    public function getAgent() {
        return $this->_agent;
    }

}