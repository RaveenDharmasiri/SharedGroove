<?php

class Post
{
    private $postId;
    private $postContent;
    private $creatorEmail;
    private $postTimeStamp;
    private $creatorId;
    private $creatorFirstName;
    private $creatorLastName;
    private $creatorProfilePicture;

    public function setPostId($postId) {
        $this->postId = $postId;
    }

    public function getPostId() {
        return $this->postId;
    }

    public function setPostContent($postContent)
    {
        $this->postContent = $postContent;
    }

    public function getPostContent()
    {
        return $this->postContent;
    }

    public function setCreatorEmail($creatorEmail)
    {
        $this->creatorEmail = $creatorEmail;
    }

    public function getCreatorEmail()
    {
        return $this->creatorEmail;
    }

    public function setPostTimeStamp($postTimeStamp)
    {
        $this->postTimeStamp = $postTimeStamp;
    }

    public function getPostTimeStamp()
    {
        return $this->postTimeStamp;
    }

    public function setCreatorId($creatorId)
    {
        $this->creatorId = $creatorId;
    }

    public function getCreatorId()
    {
        return $this->creatorId;
    }

    public function setCreatorFirstName($creatorFirstName)
    {
        $this->creatorFirstName = $creatorFirstName;
    }

    public function getCreatorFirstName()
    {
        return $this->creatorFirstName;
    }

    public function setCreatorLastName($creatorLastName)
    {
        $this->creatorLastName = $creatorLastName;
    }

    public function getCreatorLastName()
    {
        return $this->creatorLastName;
    }

    public function setCreatorProfilePicture($creatorProfilePicture) {
        $this->creatorProfilePicture = $creatorProfilePicture;
    }

    public function getCreatorProfilePicture() {
        return $this->creatorProfilePicture;
    }
}
