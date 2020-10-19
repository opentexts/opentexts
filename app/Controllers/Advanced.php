<?php namespace App\Controllers;

class Advanced extends BaseController
{
	public function index()
	{
            $data['title'] = "Advanced Search";
            
            $title = filter_input(INPUT_GET, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
            $data['searchtitle'] = $title;
            $creator = filter_input(INPUT_GET, 'creator', FILTER_SANITIZE_SPECIAL_CHARS);
            $data['searchcreator'] = $creator;
            $yearfrom = filter_input(INPUT_GET, 'yearfrom', FILTER_SANITIZE_SPECIAL_CHARS);
            $data['searchyearfrom'] = $yearfrom;
            $yearto = filter_input(INPUT_GET, 'yearto', FILTER_SANITIZE_SPECIAL_CHARS);
            $data['searchyearto'] = $yearto;
            
            echo view('templates/site-header', $data); 
            echo view('templates/navigation-primary', $data);
            echo view('advanced', $data);
            echo view('templates/site-footer');    
	}

	//--------------------------------------------------------------------

}
