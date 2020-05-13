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
        
        
        // Was a collection facet selected?
        if (!empty($_GET['collection'])) {
            $collection = $_GET['collection'];
            //$query->createFilterQuery('collection')->setQuery('collection_facet:'.$collection);
            $filterQuery = $query->createFilterQuery('fq1')->setQuery('collection_facet:"' . $collection . '"');
            $query->addFilterQuery($filterQuery);
        }
          
        // Get the facetset component
        $facetSet = $query->getFacetSet();

        // Create a facet field instance and set options
        $facetSet->createFacetField('collf')->setField('collection_facet');

        // executes the query and returns the result
        $resultset = $client->select($query);

        $data['resultcount'] = $resultset->getNumFound();
        $data['collectionfacet'] = $resultset->getFacetSet()->getFacet('collf');
        $data['results'] = $resultset;

        echo view('search', $data);
        echo view('templates/footer');
    }

    //--------------------------------------------------------------------

}
