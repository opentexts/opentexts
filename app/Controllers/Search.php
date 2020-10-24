<?php namespace App\Controllers;

use App\Models\OTQuery;
use App\Models\OTAdvancedQuery;
use CodeIgniter\Controller;
use Solarium\Client;
use Solarium\Core\Client\Adapter\Curl;
use Solarium\QueryType\Select\Query\FilterQuery;

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
        $include_score = getenv('CI_ENVIRONMENT') !== 'production' && isset($_GET['debug_score']);

        $q = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty($q)) $q = "";
        
        $advanced = filter_input(INPUT_GET, 'advanced', FILTER_SANITIZE_SPECIAL_CHARS);
        if ((!empty($advanced)) && ($advanced == 'true')) {
            $title = filter_input(INPUT_GET, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
            $data['searchtitle'] = $title;
            $creator = filter_input(INPUT_GET, 'creator', FILTER_SANITIZE_SPECIAL_CHARS);
            $data['searchcreator'] = $creator;
            $yearfrom = filter_input(INPUT_GET, 'yearfrom', FILTER_SANITIZE_SPECIAL_CHARS);
            $data['searchyearfrom'] = $yearfrom;
            $yearto = filter_input(INPUT_GET, 'yearto', FILTER_SANITIZE_SPECIAL_CHARS);
            $data['searchyearto'] = $yearto;
            $q = new OTAdvancedQuery($title, $creator, $yearfrom, $yearto);
        } else {
            $q = new OTQuery($q);
        }

        // Create a client instance
        $client = new Client($config->solarium);

        // Set the solarium timeout setting from the Solr.php config file
        $adapter = new Curl();
        $adapter->setTimeout($config->solariumTimeout);
        $client->setAdapter($adapter);
                
        // Get a select query instance
        $query = $client->createSelect();
        $q->applyQuery($query);
        // Only bring back the fields required
        $fl = array('organisation', 'title', 'urlMain', 'creator', 'publisher', 'placeOfPublication', 'year',
            'urlPDF', 'urlIIIF', 'urlPlainText', 'urlALTOXML', 'urlOther', 'id');
        if($include_score)
        {
            array_push($fl, "score");
        }
        $query->setFields($fl);
        
        // Generate the URL without pagination details
        $url = '/search/?' . $q->getQuery();

        // Was an organisation facet selected?
        $organisation = filter_input(INPUT_GET, 'organisation', FILTER_SANITIZE_SPECIAL_CHARS);
        $organisation = str_replace("&#39;", "'", $organisation);
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
        $query->addSort("score", "desc");
        // Get the facetset component
        $facetSet = $query->getFacetSet();

        // Create facet field instances
        $facetSet->createFacetField('orgf')->setField('organisation_facet')->addExclude("filter-org");
        $facetSet->createFacetField('langf')->setField('language_facet')->addExclude("filter-lang");

        $hl = $query->getHighlighting();
        $hl->setFields('title, creator, year, publisher, placeOfPublication');
        $hl->setSimplePrefix('<em class="text-current not-italic font-semibold">');
        $hl->setSimplePostfix('</em>');

        // Execute the query and returns the result
        $resultset = $client->select($query);

        // Send the parameters to the view
        $data['q'] = $q->getPlainQuery();
        $data['resultcount'] = $resultset->getNumFound();
        $data['organisationfacet'] = $resultset->getFacetSet()->getFacet('orgf');
        $data['languagefacet'] = $resultset->getFacetSet()->getFacet('langf');
        $data['start'] = $start;
        $data['include_score'] = $include_score;
        
        // If there were fewer results returned than the count, update the count
        if ($resultset->getNumFound() < $count) $count = $resultset->getNumFound();
        $data['count'] = $count;
        
        $data['url'] = $url;

        $data['exporturl'] = "/search/export/" . substr($url, 8);

        $resultList = array();
        foreach ($resultset as $document) :
            // Highlight search terms in results
            $title = $document->title;
            $creators = $document->creator;
            $publishers = $document->publisher;
            $resultOrganisation = $document->organisation;
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
                    if ($field == "organisation") {
                        $resultOrganisation = $highlight[0];
                    }
                endforeach;
            endif;

            array_push($resultList, array(
                "title" => $title,
                "creators" => $creators,
                "publishers" => $publishers,
                "placesOfPublication" => $placesOfPublication,
                "organisation" => $resultOrganisation,
                "urlMain" => $document->urlMain,
                "urlPDF" => $document->urlPDF,
                "urlIIIF" => $document->urlIIIF,
                "urlPlainText" => $document->urlPlainText,
                "urlALTOXML" => $document->urlALTOXML,
                "urlOther" => $document->urlOther,
                "year" => $document->year,
                "score" => $document->score
            ));
        endforeach;
        $data['payload'] = array("results" => $resultList, 
                                 "query" => array("q" => $q->getPlainQuery(), "start" => $start, "language" => $language, "organisation" => $organisation),
                                 "filters" =>  array(
                                     "organisation" => $resultset->getFacetSet()->getFacet('orgf')->getValues(),
                                     "language" => $resultset->getFacetSet()->getFacet('langf')->getValues()
                                 ),
                                 "total" => $resultset->getNumFound(),
                                 "advanced" => $advanced);

        return $data;
    }

    public function index()
    {
        $data = $this->getData();
        $data['title'] = "Search";
        $data['advanced'] = False;

        echo view('templates/site-header', $data);

        $advanced = filter_input(INPUT_GET, 'advanced', FILTER_SANITIZE_SPECIAL_CHARS);
        if ((!empty($advanced)) && ($advanced == 'true')) {
            $data['title'] = "Advanced Search";
            $data['showlogo'] = True;
            echo view('templates/non-search-header', $data);
            $data['advanced'] = True;
        } else {
            echo view('templates/search-header', $data);
        }
        
        echo view('search', $data);
        echo view('templates/site-footer');
    }

    public function data()
    {
        // Setting the content type removes the CodeIgniter toolbar when running in the development environment
        // This adds extra unwanted HTMl to the JSON response, so breaks it otherwise
        // See: https://forum.codeigniter.com/thread-74553.html
        $this->response->setContentType('Content-Type: application/json');
        
        $data = $this->getData();
        echo json_encode($data["payload"]);
    }

    public function export() 
    {
        $config = config('Solr');        
         
        $advanced = filter_input(INPUT_GET, 'advanced', FILTER_SANITIZE_SPECIAL_CHARS);
        if ((!empty($advanced)) && ($advanced == 'true')) {
            $title = filter_input(INPUT_GET, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
            $creator = filter_input(INPUT_GET, 'creator', FILTER_SANITIZE_SPECIAL_CHARS);
            $yearfrom = filter_input(INPUT_GET, 'yearfrom', FILTER_SANITIZE_SPECIAL_CHARS);
            $yearto = filter_input(INPUT_GET, 'yearto', FILTER_SANITIZE_SPECIAL_CHARS);
            $q = new OTAdvancedQuery($title, $creator, $yearfrom, $yearto);
        } else {
            $q = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_SPECIAL_CHARS);
            if (empty($q)) $q = "";
            $q = new OTQuery($q);
        }
        
        // Generate the solr search URL
        $url = "http://" . $config->solarium['endpoint']['localhost']['host'] .
               ":" . $config->solarium['endpoint']['localhost']['port'] .
               $config->solarium['endpoint']['localhost']['path'] .
               "solr/" . $config->solarium['endpoint']['localhost']['core'] .
               "/select?" . $q->getSolrQuery();
        
        // Was an organisation facet selected?
        $organisation = filter_input(INPUT_GET, 'organisation', FILTER_SANITIZE_SPECIAL_CHARS);
        // Quick fix for organisations containing a 's (such as Queen's University Belfast)
        $organisation = str_replace("&#39;s", "'s", $organisation);
        $organisations = explode("|", $organisation);
        $organisationFQ = "";
        foreach ($organisations as $value) {
            if (!$value == "") {
                $organisationFQ = $organisationFQ . '"' . $value . '" ';
            }
        }
        if (!empty($organisationFQ)) {
            $url = $url . '&fq=organisation:(' . urlencode($organisationFQ) . ')';
        }
        
        // Was a language facet selected?
        $language = filter_input(INPUT_GET, 'language', FILTER_SANITIZE_SPECIAL_CHARS);
        $languages = explode("|", $language);
        $languageFQ = "";
        foreach ($languages as $value) {
            if (!$value == "") {
                $languageFQ = $languageFQ . '"' . $value . '" ';
            }
        }
        if (!empty($languageFQ)) {      
            $url = $url . '&fq=language:(' . urlencode($languageFQ) . ')';
        }
        
        // What format do we want?
        $format = filter_input(INPUT_GET, 'format', FILTER_SANITIZE_SPECIAL_CHARS);
        if ((!empty($format)) && ($format == "xml")) {
            $url = $url . "&wt=xml";
            $extension = ".xml";
            $mime = "application/xml";
        } else if ((!empty($format)) && ($format == "json")) {
            $url = $url . "&wt=json";
            $extension = ".json";
            $mime = "application/json";
        } else {
            $url = $url . "&wt=csv";
            $extension = ".csv";
            $mime = "text/csv";
        }
        
        // Only export standard fields
        $url = $url . "&fl=organisation,title,urlMain,year,publisher,creator,topic,description,urlPDF,urlIIIF,urlPlainText,urlALTOXML,urlOther,placeOfPublication,licence,idOther,catLink,language,idLocal";
        
        $rows = filter_input(INPUT_GET, 'rows', FILTER_SANITIZE_SPECIAL_CHARS);
        if ((!empty($rows)) && (is_numeric($rows)) && ($rows <= 5000) && ($rows >= 1)) {
            // We have a good number for $rows
        } else {
            $rows = 5000;
        }
        $url = $url . "&rows=" . $rows;
        
        // Concoct the filename
        $exportFilename = 'export-' . $q->sanitisedQuery . '-'. date("Ymd");
        $exportFilename = str_replace(' ', '_', $exportFilename);
        $exportFilename = preg_replace('/[^A-Za-z0-9\-\_]/', '', $exportFilename) . $extension;
        
        $this->response->setContentType('Content-Type: " . $mime . "; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $exportFilename);
        $fp = fopen($url, 'rb');
        fpassthru($fp);
    }
}
