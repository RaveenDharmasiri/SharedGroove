<?php
class GenreSearchController extends CI_Controller
{
    public function findSearchResults($genreType)
    {
        $this->load->model('SearchGenreService/SearchGenre');
        $searchResult = $this->SearchGenre->findUsersBasedOnGenre($genreType);
        
        $this->load->view('properties/searchResult', $searchResult);
    }
}
