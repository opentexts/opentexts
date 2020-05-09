<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Contribute extends Controller
{
    public function index()
    {
        $data['title'] = "Contribute";
        
        echo view('templates/header', $data); 
        echo view('contribute');
        echo view('templates/footer');
    }

    //--------------------------------------------------------------------

}