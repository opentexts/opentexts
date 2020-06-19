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
            $organisation = esc($_GET['organisation']);
            $data['selectedorganisation'] = $organisation;
            $filterQuery = $query->createFilterQuery('fqOrg')->setQuery('organisation_facet:"' . $organisation . '"');
            $query->addFilterQuery($filterQuery);
            $data['organisation'] = $organisation;
            $url = $url . '&organisation=' . $organisation;
        }
        
        // Was a language facet selected?
        if (!empty($_GET['language'])) {
            $language = esc($_GET['language']);
            $data['selectedlanguage'] = $language;
            $filterQuery = $query->createFilterQuery('fqLang')->setQuery('language_facet:"' . $language . '"');
            $query->addFilterQuery($filterQuery);
            $data['language'] = $language;
            $url = $url . '&language=' . $language;
        }
        
        // Where to start and end the query (pagination)
        $start = 0;
        if (!empty($_GET['start'])) {
               $start = esc($_GET['start']);
        }
        $query->setStart($start);
          
        // Get the facetset component
        $facetSet = $query->getFacetSet();

        // Create facet field instances
        $facetSet->createFacetField('orgf')->setField('organisation_facet');
        $facetSet->createFacetField('langf')->setField('language_facet');

        // executes the query and returns the result
        $resultset = $client->select($query);

        // Send the parameters to the view
        $data['resultcount'] = $resultset->getNumFound();
        $data['organisationfacet'] = $resultset->getFacetSet()->getFacet('orgf');
        $data['languagefacet'] = $resultset->getFacetSet()->getFacet('langf');
        $data['results'] = $resultset;
        $data['start'] = $start;
        $data['url'] = $url;
                        
        echo view('search', $data);
        echo view('templates/footer');
    }

    //--------------------------------------------------------------------

}
