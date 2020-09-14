<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Help extends Controller
{
    public function index()
    {
        $data['title'] = "Help";
        
        echo view('templates/site-header', $data); 
        echo view('templates/search-header', $data);
        echo view('help');
        echo view('templates/site-footer');
    }

    //--------------------------------------------------------------------

}
