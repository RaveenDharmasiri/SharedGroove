<?php

class Contact
{
    private $contactId;
    private $name;
    private $surname;
    private $email;
    private $telephoneNo;

    public function setContactId($contactId) {
        $this->contactId = $contactId;
    }

    public function getContactId() {
        return $this->contactId;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    // public function setSurname($surname) {
    //     $this->surname = $surname;
    // }

    // public function getSurname() {
    //     return $this->surname;
    // }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setTelephoneNo($telephoneNo) {
        $this->telephoneNo = $telephoneNo;
    }

    public function getTelephoneNo() {
        return $this->telephoneNo;
    }
}
