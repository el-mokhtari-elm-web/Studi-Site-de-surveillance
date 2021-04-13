<?php

class Contact {

private $_contact;

    public function __construct($contact) {
        $this->setContact($contact);
    }

    public function setContact($contact) {
        $this->_contact = $contact;
    }

    public function getContact() {
        return $this->_contact;
    }

}