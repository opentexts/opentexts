<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Accessibility extends Controller
{
    public function index()
    {
        $data['title'] = "Accessibility";
        
        echo view('templates/site-header', $data); 
        echo view('templates/search-header', $data);
        echo view('accessibility');
        echo view('templates/site-footer');
    }

    //--------------------------------------------------------------------

}
