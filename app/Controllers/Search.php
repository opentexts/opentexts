<?php namespace App\Controllers;

use CodeIgniter\Controller;

helper('form');

class Search extends Controller
{
    public function index()
    {
        $data['title'] = "Search";
        
        $config = config('Solr');        
        
        // TODO Make much more robust (if is_empty($q)) etc
        $q = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_SPECIAL_CHARS);
        
        // Quick fix for double quotes around searches
        $q = str_replace("&#34;", '"', $q);
        $data['q'] = $q;
        
        // Fix special solr characters - only add fixes here for solr, not for HTML (see a few lines above)
        $q = str_replace(":", '\:', $q);
        $q = str_replace("[", '\[', $q);
        $q = str_replace("]", '\]', $q);
        $q = str_replace("{", '\{', $q);
        $q = str_replace("}", '\}', $q);
        
        if ((empty($q)) || ($q == "")) { 
            $q = "*";
        }
        
        echo view('templates/header-search', $data); 
        
        // Create a client instance
        $client = new \Solarium\Client($config->solarium);

        // Get a select query instance
        $query = $client->createSelect();
        $query->setQuery($q);
        
        // Generate the URL without pagination details
        $url = '/search/?q=' . $q;
             
        // Was an organisation facet selected?
        $organisation = filter_input(INPUT_GET, 'organisation', FILTER_SANITIZE_SPECIAL_CHARS);
        // Quick fix for organisations containing a 's (such as Queen's University Belfast)
        $organisation = str_replace("&#39;s", "'s", $organisation);
        if (!empty($organisation)) {
            $data['selectedorganisation'] = $organisation;
            $filterQuery = $query->createFilterQuery('fqOrg')->setQuery('organisation_facet:"' . $organisation . '"');
            $query->addFilterQuery($filterQuery);
            $data['organisation'] = $organisation;
            $url = $url . '&organisation=' . $organisation;
        }
        
        // Was a language facet selected?
        $language = filter_input(INPUT_GET, 'language', FILTER_SANITIZE_SPECIAL_CHARS);
        if (!empty($language)) {
            $data['selectedlanguage'] = $language;
            $filterQuery = $query->createFilterQuery('fqLang')->setQuery('language_facet:"' . $language . '"');
            $query->addFilterQuery($filterQuery);
            $data['language'] = $language;
            $url = $url . '&language=' . $language;
        }
        
        // Where to start and end the query (pagination)
        $start = 0;
        if (!empty($_GET['start'])) {
            $start = filter_input(INPUT_GET, 'start', FILTER_SANITIZE_SPECIAL_CHARS);
        }
        $query->setStart($start);
          
        // Get the facetset component
        $facetSet = $query->getFacetSet();

        // Create facet field instances
        $facetSet->createFacetField('orgf')->setField('organisation_facet');
        $facetSet->createFacetField('langf')->setField('language_facet');

        $hl = $query->getHighlighting();
        $hl->setFields('title, creator, year, publisher, placeOfPublication');
        $hl->setSimplePrefix('<b><mark>');
        $hl->setSimplePostfix('</mark></b>');
        
        // Execute the query and returns the result
        $resultset = $client->select($query);

        // Send the parameters to the view
        $data['resultcount'] = $resultset->getNumFound();
        $data['organisationfacet'] = $resultset->getFacetSet()->getFacet('orgf');
        $data['languagefacet'] = $resultset->getFacetSet()->getFacet('langf');
        $data['highlighted'] = $resultset->getHighlighting();
        $data['results'] = $resultset;
        $data['start'] = $start;
        $data['url'] = $url;
                        
        echo view('search', $data);
        echo view('templates/footer');
    }

    //--------------------------------------------------------------------

}
