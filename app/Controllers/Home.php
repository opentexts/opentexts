<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
            $data['title'] = "Home";
            
            echo view('templates/header', $data); 
            echo view('welcome_message');
            echo view('templates/footer');    
	}

	//--------------------------------------------------------------------

}
