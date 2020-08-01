<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
            $data['title'] = "Home";
            $data['hero'] = True;
            echo view('templates/site-header', $data); 
            echo view('templates/navigation-primary', $data);
            echo view('home');
            echo view('templates/site-footer');    
	}

	//--------------------------------------------------------------------

}
