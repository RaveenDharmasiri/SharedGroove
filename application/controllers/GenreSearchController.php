<?php
class GenreSearchController extends CI_Controller
{
    public function findSearchResults($genreType)
    {
        $this->load->model('SearchGenreService/SearchGenre');
        $searchResult = $this->SearchGenre->findUsersBasedOnGenre($genreType);

        $returnArray = array(
            'genreType' => $genreType,
            'searchResult' => $searchResult
        );

        $this->load->view('properties/searchResult', $returnArray);
        var_dump($returnArray);
    }

    public function followGenreResultUser($userId, $genreType)
    {
        $currentUserEmail = $this->session->userdata('email');
        if ($currentUserEmail == null) {
            $this->load->view('properties/login');
        } else {
            $this->load->model('FollowUser');
            $this->FollowUser->getEmailOfFollowingUser($userId);
            $this->findSearchResults($genreType);
        }
    }
}
