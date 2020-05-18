<?php namespace App\Controllers;

use CodeIgniter\Controller;

class History extends Controller
{
    public function index()
    {
        $data['title'] = "Team";
        
        echo view('templates/header', $data); 
        echo view('history');
        echo view('templates/footer');
    }

    //--------------------------------------------------------------------

}