<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Support extends Controller
{
    public function index()
    {
        $data['title'] = "Support";
        
        echo view('templates/site-header', $data); 
        echo view('templates/navigation-primary', $data);
        echo view('support');
        echo view('templates/site-footer');
    }

    //--------------------------------------------------------------------

}
