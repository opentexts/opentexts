<?php namespace App\Controllers;

use CodeIgniter\Controller;

class About extends Controller
{
    public function index()
    {
        $data['title'] = "About";
        
        echo view('templates/site-header', $data); 
        echo view('templates/navigation-primary', $data);
        echo view('about');
        echo view('templates/site-footer');
    }

    //--------------------------------------------------------------------

}
