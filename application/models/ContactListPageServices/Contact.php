<?php

class Contact
{
    private $contactId;
    private $name;
    private $email;
    private $telephoneNo;
    private $tags = array();

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

    public function setTags($tags) {
        $this->tags = $tags;
    }

    public function getTags() {
        return $this->tags;
    }
}
