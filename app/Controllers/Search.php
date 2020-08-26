<?php namespace App\Controllers;

use CodeIgniter\Controller;
use Solarium\Client;
use Solarium\QueryType\Select\Query\FilterQuery;

helper('form');

class Search extends Controller
{
    function applyFilter(FilterQuery $filter, string $facet, string $value) : FilterQuery
    {
        $values = explode("|", urldecode($value));
        $queryString = join('" "', $values);
        $filter->setQuery($facet . ':("' . $queryString . '")');
        return $filter;
    }

    function getData()
    {
        $config = config('Solr');

        // TODO Make much more robust (if is_empty($q)) etc
        $q = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_SPECIAL_CHARS);

        // Quick fix for double quotes around searches
        $q = str_replace("&#34;", '"', $q);

        // Quick fix if there is an odd number of double quotes
        if (substr_count($q, '"') % 2 == 1) { $q .= '"'; }

        // Store the query
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


        // Create a client instance
        $client = new Client($config->solarium);

        // Get a select query instance
        $query = $client->createSelect();
        $query->setQuery($q);

        // Generate the URL without pagination details
        $url = '/search/?q=' . $q;

        // Was an organisation facet selected?
        $organisation = filter_input(INPUT_GET, 'organisation', FILTER_SANITIZE_SPECIAL_CHARS);
        if (!empty($organisation)) {
            $data['selectedorganisation'] = $organisation;
            $filterQuery = $query->createFilterQuery('fqOrg');
            $filterQuery = $this->applyFilter($filterQuery, "organisation_facet", $organisation)->addTag("filter-org");
            $query->addFilterQuery($filterQuery);
            $url = $url . '&organisation=' . $organisation;
        }
$data['organisation'] = $organisation;
        // Was a language facet selected?
        $language = filter_input(INPUT_GET, 'language', FILTER_SANITIZE_SPECIAL_CHARS);
        if (!empty($language)) {
            $data['selectedlanguage'] = $language;
            $filterQuery = $query->createFilterQuery('fqLang');
            $filterQuery = $this->applyFilter($filterQuery, "language_facet", $language)->addTag("filter-lang");
            $query->addFilterQuery($filterQuery);
            $url = $url . '&language=' . $language;
        }
$data['language'] = $language;
        // Where to start and end the query (pagination)
        $start = 0;
        if (!empty($_GET['start'])) {
            $start = filter_input(INPUT_GET, 'start', FILTER_SANITIZE_SPECIAL_CHARS);
        }
        $query->setStart($start);

        $count = 10;
        $query->setRows($count);
        // Get the facetset component
        $facetSet = $query->getFacetSet();

        // Create facet field instances
        $facetSet->createFacetField('orgf')->setField('organisation_facet')->addExclude("filter-org");
        $facetSet->createFacetField('langf')->setField('language_facet')->addExclude("filter-lang");

        $hl = $query->getHighlighting();
        $hl->setFields('title, creator, year, publisher, placeOfPublication');
        $hl->setSimplePrefix('<em class="bg-gray-100 text-current not-italic">');
        $hl->setSimplePostfix('</em>');

        // Execute the query and returns the result
        $resultset = $client->select($query);

        // Send the parameters to the view
        $data['resultcount'] = $resultset->getNumFound();
        $data['organisationfacet'] = $resultset->getFacetSet()->getFacet('orgf');
        $data['languagefacet'] = $resultset->getFacetSet()->getFacet('langf');
        $data['start'] = $start;
        $data['count'] = $count;
        $data['url'] = $url;

        $data['exporturl'] = "/search/export/" . substr($url, 8);

        $resultList = array();
        foreach ($resultset as $document) :
            // Highlight search terms in results
            $title = $document->title;
            $creators = $document->creator;
            $publishers = $document->publisher;
            $placesOfPublication = $document->placeOfPublication;
            $highlightedDoc = $resultset->getHighlighting()->getResult($document->id);

            if ($highlightedDoc) :
                foreach ($highlightedDoc as $field => $highlight):
                    if ($field == "title") $title = $highlight[0];
                    if ($field == "creator") {
                        $creators = array();
                        foreach ($highlight as $each) {
                            array_push($creators, $each);
                        }
                    }
                    if ($field == "publisher") {
                        $publishers = array();
                        foreach ($highlight as $each) {
                            array_push($publishers, $each);
                        }
                    }
                    if ($field == "placeOfPublication") {
                        $placesOfPublication = array();
                        foreach ($highlight as $each) {
                            array_push($placesOfPublication, $each);
                        }
                    }
                endforeach;
            endif;

            array_push($resultList, array(
                "title" => $title,
                "creators" => $creators,
                "publishers" => $publishers,
                "placesOfPublication" => $placesOfPublication,
                "urlMain" => $document->urlMain,
                "urlPDF" => $document->urlPDF,
                "urlIIIF" => $document->urlIIIF,
                "urlOther" => $document->urlOther,
                "year" => $document->year
            ));
        endforeach;
        $data['payload'] = array("results" => $resultList, "query" => array("q" => $q, "start" => $start, "language" => $language, "organisation" => $organisation));

        return $data;
    }

    public function index()
    {

        $data = $this->getData();
        $data['title'] = "Search";

        echo view('templates/site-header', $data);
        echo view('templates/search-header', $data);

        echo view('search', $data);
        echo view('templates/site-footer');
    }

    public function data()
    {
        $data = $this->getData();
        echo json_encode($data["payload"]["results"]);
    }

    public function export() 
    {
        $config = config('Solr');        
        
        // TODO Make much more robust (if is_empty($q)) etc
        $q = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_SPECIAL_CHARS);
        
        // Quick fix for double quotes around searches
        $q = str_replace("&#34;", '"', $q);
        
        // Fix special solr characters - only add fixes here for solr, not for HTML (see a few lines above)
        $q = str_replace(":", '\:', $q);
        $q = str_replace("[", '\[', $q);
        $q = str_replace("]", '\]', $q);
        $q = str_replace("{", '\{', $q);
        $q = str_replace("}", '\}', $q);
        
        // Generate the solr search URL
        $url = "http://" . $config->solarium['endpoint']['localhost']['host'] .
               ":" . $config->solarium['endpoint']['localhost']['port'] .
               $config->solarium['endpoint']['localhost']['path'] .
               "solr/" . $config->solarium['endpoint']['localhost']['core'] .
               "/select?q=" . $q;
        
        // Was an organisation facet selected?
        $organisation = filter_input(INPUT_GET, 'organisation', FILTER_SANITIZE_SPECIAL_CHARS);
        // Quick fix for organisations containing a 's (such as Queen's University Belfast)
        $organisation = str_replace("&#39;s", "'s", $organisation);
        if (!empty($organisation)) {
            $url = $url . '&fq=organisation_facet:"' . urlencode($organisation) . '"';
        }
        
        // Was a language facet selected?
        $language = filter_input(INPUT_GET, 'language', FILTER_SANITIZE_SPECIAL_CHARS);
        if (!empty($language)) {
            
            $url = $url . '&fq=language_facet:"' . urlencode($language) . '"';
        }
        
        // We want a CSV
        $url = $url . "&wt=csv";
        
        // Only export standard fields
        $url = $url . "&fl=organisation,idLocal,title,urlMain,year,publisher,creator,topic,description,urlPDF,urlOther,urlIIIF,placeOfPublication,licence,idOther,catLink,language";
        
        // Limit to 5,000 rows for now
        $url = $url . "&rows=5000";
        
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=data.csv');
        $fp = fopen($url, 'rb');
        fpassthru($fp);
    }
}
