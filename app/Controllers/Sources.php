<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Sources extends Controller
{
    public function index()
    {
        $data['title'] = "Sources";
        
        echo view('templates/header', $data); 
        echo view('sources');
        echo view('templates/footer');
    }

    //--------------------------------------------------------------------

}
