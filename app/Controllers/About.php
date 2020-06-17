<?php namespace App\Controllers;

use CodeIgniter\Controller;

class About extends Controller
{
    public function index()
    {
        $data['title'] = "About";
        
        echo view('templates/header', $data); 
        echo view('about');
        echo view('templates/footer');
    }

    //--------------------------------------------------------------------

}