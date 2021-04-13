<?php

class Admin {

private $_admin;
private $_emailAdmin;
private $_passAdmin;

    public function __construct($emailAdmin, $passAdmin) {
        $this->setEmailAdmin($emailAdmin);
        $this->setPassAdmin($passAdmin);
    }

    public function setAdmin($admin) {
        $this->_admin = $admin;
    }

    public function setEmailAdmin($emailAdmin) {
        $this->_emailAdmin = $emailAdmin;
    }

    public function setPassAdmin($passAdmin) {
        $this->_passAdmin = $passAdmin;
    }

    public function getAdmin() {
        return $this->_admin;
    }

    public function getEmailAdmin() {
        return $this->_emailAdmin;
    }

    public function getPassAdmin() {
        return $this->_passAdmin;
    }

}