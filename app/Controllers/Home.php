<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
            $data['title'] = "Home";
            $data['hero'] = True;
            echo view('templates/header', $data); 
            echo view('home');
            echo view('templates/footer');    
	}

	//--------------------------------------------------------------------

}
