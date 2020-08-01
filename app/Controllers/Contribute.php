<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Contribute extends Controller
{
    public function index()
    {
        $data['title'] = "Contribute";
        
        echo view('templates/site-header', $data); 
        echo view('templates/navigation-primary', $data);
        echo view('contribute');
        echo view('templates/site-footer');
    }

    //--------------------------------------------------------------------

}
