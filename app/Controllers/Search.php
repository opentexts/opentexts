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
             
        // Was a collection facet selected?
        if (!empty($_GET['collection'])) {
            $collection = $_GET['collection'];
            //$query->createFilterQuery('collection')->setQuery('collection_facet:'.$collection);
            $filterQuery = $query->createFilterQuery('fq1')->setQuery('collection_facet:"' . $collection . '"');
            $query->addFilterQuery($filterQuery);
            $data['collection'] = $collection;
            $url = $url . '&collection=' . $collection;
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
        $facetSet->createFacetField('collf')->setField('collection_facet');

        // executes the query and returns the result
        $resultset = $client->select($query);

        // Send the parameters to the view
        $data['resultcount'] = $resultset->getNumFound();
        $data['collectionfacet'] = $resultset->getFacetSet()->getFacet('collf');
        $data['results'] = $resultset;
        $data['start'] = $start;
        $data['url'] = $url;
                        
        echo view('search', $data);
        echo view('templates/footer');
    }

    //--------------------------------------------------------------------

}
