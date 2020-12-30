<?php namespace App\Controllers;

class Advanced extends BaseController
{
	public function index()
	{
            $data['title'] = "Advanced Search";
            
            $data['searchtitle'] = filter_input(INPUT_GET, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
            $data['searchcreator'] = filter_input(INPUT_GET, 'creator', FILTER_SANITIZE_SPECIAL_CHARS);
            $data['searchyearfrom'] = filter_input(INPUT_GET, 'yearfrom', FILTER_SANITIZE_SPECIAL_CHARS);
            $data['searchyearto'] = filter_input(INPUT_GET, 'yearto', FILTER_SANITIZE_SPECIAL_CHARS);
            $data['searchpublisher'] = filter_input(INPUT_GET, 'publisher', FILTER_SANITIZE_SPECIAL_CHARS);
            $data['searchplaceofpublication'] = filter_input(INPUT_GET, 'placeofpublication', FILTER_SANITIZE_SPECIAL_CHARS);
            
            $data['searchplaintext'] = filter_input(INPUT_GET, 'plaintext', FILTER_SANITIZE_SPECIAL_CHARS);
            $data['searchiiif'] = filter_input(INPUT_GET, 'iiif', FILTER_SANITIZE_SPECIAL_CHARS);
            $data['searchaltoxml'] = filter_input(INPUT_GET, 'altoxml', FILTER_SANITIZE_SPECIAL_CHARS);
            $data['searchpdf'] = filter_input(INPUT_GET, 'pdf', FILTER_SANITIZE_SPECIAL_CHARS);
            $data['searchtei'] = filter_input(INPUT_GET, 'tei', FILTER_SANITIZE_SPECIAL_CHARS);
            
            echo view('templates/site-header', $data); 
            echo view('templates/non-search-header', $data);
            echo view('advanced', $data);
            echo view('templates/site-footer');    
	}

	//--------------------------------------------------------------------

}
