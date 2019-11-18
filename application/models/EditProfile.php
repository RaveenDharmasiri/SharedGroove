<?php

class EditProfile extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function uploadImage($imagePath, $email)
    {
        $updateArray = array(
            'profilePicture' => $imagePath,
        );
        $this->db->where('email', $email);
        $this->db->update('User', $updateArray);
    }

    public function uploadGenres($genres, $email)
    {
        $genresLength = sizeof($genres);

        for ($x = 0; $x < $genresLength; $x++) {
            $userGenreData = array(
                'userEmail' => $email,
                'genreType' => $genres[$x],
            );

            $this->db->insert('UserGenre', $userGenreData);
        }
    }
}
