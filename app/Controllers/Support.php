<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Support extends Controller
{
    public function index()
    {
        $data['title'] = "Support";
        
        echo view('templates/header', $data); 
        echo view('support');
        echo view('templates/footer');
    }

    //--------------------------------------------------------------------

}