<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Privacy extends Controller
{
    public function index()
    {
        $data['title'] = "Privacy";
        
        echo view('templates/site-header', $data); 
        echo view('templates/search-header', $data);
        echo view('privacy');
        echo view('templates/site-footer');
    }

    //--------------------------------------------------------------------

}
