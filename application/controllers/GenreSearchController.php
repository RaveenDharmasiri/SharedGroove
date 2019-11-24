<?php
class GenreSearchController extends CI_Controller
{
    /**
     * This controller function invoked the model method which search for all the users belonging to a particular genre. 
     * The genre type is given as a parameter.
     */
    public function findSearchResults($genreType)
    {
        /**
         * This is to check if the session still have the data of the currently logged in user.
         * Only if the data is available the model function is accessed.
         * If not the user is sent to the login page. 
         */
        $currentUserEmail = $this->session->userdata('email');
        if ($currentUserEmail == null) {
            $this->load->view('properties/login');
        } else {
            $this->load->model('SearchGenreService/SearchGenre');
            $searchResult = $this->SearchGenre->findUsersBasedOnGenre($genreType);

            $returnArray = array(
                'genreType' => $genreType,
                'searchResult' => $searchResult
            );

            $this->load->view('properties/searchResult', $returnArray);
        }
    }

    /**
     * This controller function is invoked if the currently logged in user follows a user who was shown as a result of a genre.
     */
    public function followGenreResultUser($userId, $genreType)
    {
        /**
         * This is to check if the session still have the data of the currently logged in user.
         * Only if the data is available the model function is accessed.
         * If not the user is sent to the login page. 
         */
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
