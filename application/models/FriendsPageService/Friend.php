<?php
class Friend
{
    private $userId;
    private $firstName;
    private $lastName;
    private $email;
    private $profilePicture;

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setProfilePicture($profilePicture)
    {
        $this->profilePicture = $profilePicture;
    }

    public function getProfilePicture()
    {
        return $this->profilePicture;
    }
}
