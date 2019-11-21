<?php
class User
{
    private $userId;
    private $firstName;
    private $lastName;
    private $email;
    private $profilePicture;
    private $followerCount = 0;
    private $followingCount = 0;
    private $friendCount = 0;
    private $userGenres = array();

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

    public function setFollowerCount($followerCount)
    {
        $this->followerCount = $followerCount;
    }

    public function getFollowerCount()
    {
        return $this->followerCount;
    }

    public function setFollowingCount($followingCount)
    {
        $this->followingCount = $followingCount;
    }

    public function getFollowingCount()
    {
        return $this->followingCount;
    }

    public function setFriendCount($friendCount)
    {
        $this->friendCount = $friendCount;
    }

    public function getFriendCount()
    {
        return $this->friendCount;
    }

    public function setUserGenres($userGenres)
    {
        $this->userGenres = $userGenres;
    }

    public function getUserGenres()
    {
        return $this->userGenres;
    }
}
