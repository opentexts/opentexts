<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Team extends Controller
{
    public function index()
    {
        $data['title'] = "Team";
        
        echo view('templates/header', $data); 
        echo view('team');
        echo view('templates/footer');
    }

    //--------------------------------------------------------------------

}