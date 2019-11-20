<?php
class GenreSearchController extends CI_Controller
{
    public function findSearchResults($genreType)
    {
        $this->load->model('SearchGenreService/SearchGenre');
        $searchResult = $this->SearchGenre->findUsersBasedOnGenre($genreType);

        $returnArray = array(
            'genreType'=>$genreType,
            'searchResult'=>$searchResult
        );
        
        $this->load->view('properties/searchResult', $returnArray);
        var_dump($returnArray);
    }
}
