<?php namespace App\Controllers;

use CodeIgniter\Controller;

helper('form');

class Search extends Controller
{
    public function index()
    {
        $data['title'] = "Search";
        
        echo view('templates/header', $data); 
        
        $config = config('Solr');        
        
        // TODO Make much more robust (if is_empty($q)) etc
        $q = $_GET['q'];
        $data['q'] = $q;
        
        // Create a client instance
        $client = new \Solarium\Client($config->solarium);

        // Get a select query instance
        $query = $client->createSelect();
        $query->setQuery($q);
        
        // Generate the URL without pagination details
        $url = '/search/?q=' . $q;
             
        // Was an organisation facet selected?
        if (!empty($_GET['organisation'])) {
            $organisation = $_GET['organisation'];
            //$query->createFilterQuery('collection')->setQuery('collection_facet:'.$collection);
            $filterQuery = $query->createFilterQuery('fq1')->setQuery('organisation_facet:"' . $organisation . '"');
            $query->addFilterQuery($filterQuery);
            $data['organisation'] = $organisation;
            $url = $url . '&organisation=' . $organisation;
        }
        
        // Where to start and end the query (pagination)
        $start = 0;
        if (!empty($_GET['start'])) {
               $start = esc($_GET['start']);
        }
        $query->setStart($start);
          
        // Get the facetset component
        $facetSet = $query->getFacetSet();

        // Create a facet field instance and set options
        $facetSet->createFacetField('orgf')->setField('organisation_facet');

        // executes the query and returns the result
        $resultset = $client->select($query);

        // Send the parameters to the view
        $data['resultcount'] = $resultset->getNumFound();
        $data['organisationfacet'] = $resultset->getFacetSet()->getFacet('orgf');
        $data['results'] = $resultset;
        $data['start'] = $start;
        $data['url'] = $url;
                        
        echo view('search', $data);
        echo view('templates/footer');
    }

    //--------------------------------------------------------------------

}
