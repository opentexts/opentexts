<?php
namespace App\Models;

use Solarium\Client;
use Solarium\QueryType\Select\Query\Query;

class OTAdvancedQuery
{
    public $sanitisedTitle = "";
    public $sanitisedCreator = "";
    public $sanitisedYearFrom = "";
    public $sanitisedYearTo = "";
    public $sanitisedPublisher = "";
    public $sanitisedPlaceOfPublication = "";
    
    public $plaintext = false;
    public $sanitisedPlainText = "";
    public $iiif = false;
    public $sanitisedIIIF = "";
    public $altoxml = false;
    public $sanitisedAltoXML = "";
    public $pdf = false;
    public $sanitisedPDF = "";
    public $tei = false;
    public $sanitisedTEI = "";
    
    private $solrSafeQuery;
    private $solrSafeQueryValuesArray;

    function __construct() {
        $title = filter_input(INPUT_GET, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty($title)) $title = "";
        $creator = filter_input(INPUT_GET, 'creator', FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty($creator)) $creator = "";
        $yearFrom = filter_input(INPUT_GET, 'yearfrom', FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty($yearFrom)) $yearFrom = "";
        $yearTo = filter_input(INPUT_GET, 'yearto', FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty($yearTo)) $yearTo = "";
        $publisher = filter_input(INPUT_GET, 'publisher', FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty($publisher)) $publisher = "";
        $placeOfPublication = filter_input(INPUT_GET, 'placeofpublication', FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty($placeOfPublication)) $placeOfPublication = "";
        
        if ((!empty($_GET['plaintext'])) && ($_GET['plaintext'] == 'on')) {
            $this->plaintext = true;
            $this->sanitisedPlainText = "on";
        }
        if ((!empty($_GET['iiif'])) && ($_GET['iiif'] == 'on')) {
            $this->iiif = true;
            $this->sanitisedIIIF = "on";
        }
        if ((!empty($_GET['altoxml'])) && ($_GET['altoxml'] == 'on')) {
            $this->altoxml = true;
            $this->sanitisedAltoXML = "on";
        }
        if ((!empty($_GET['pdf'])) && ($_GET['pdf'] == 'on')) {
            $this->pdf = true;
            $this->sanitisedPDF= "on";
        }
        if ((!empty($_GET['tei'])) && ($_GET['tei'] == 'on')) {
            $this->tei = true;
            $this->sanitisedTEI = "on";
        }
        
        $solrSafeQueryFieldsArray = array();
        $this->solrSafeQueryValuesArray = array();
        
        $title = html_entity_decode($title, ENT_QUOTES | ENT_HTML5);
        $this->sanitisedTitle = $title;
        if ($title !== "") {
            array_push($solrSafeQueryFieldsArray, "(title: %Lx%)");
            array_push($this->solrSafeQueryValuesArray, $title);
        }
        
        $creator = html_entity_decode($creator, ENT_QUOTES | ENT_HTML5);
        $this->sanitisedCreator = $creator;
        if ($creator !== "") {
            array_push($solrSafeQueryFieldsArray, "(creator: %Lx%)");
            array_push($this->solrSafeQueryValuesArray, $creator);
        }
        
        $yearFrom = html_entity_decode($yearFrom, ENT_QUOTES | ENT_HTML5);
        if (!is_numeric($yearFrom)) {
            $yearFrom = "";
        } else if ($yearFrom > 3000) {
            $yearFrom = "";
        }
        $this->sanitisedYearFrom = $yearFrom;
        
        $yearTo = html_entity_decode($yearTo, ENT_QUOTES | ENT_HTML5);
        if (!is_numeric($yearTo)) {
            $yearTo = "";
        } else if ($yearFrom > 3000) {
            $yearTo = "";
        }
        $this->sanitisedYearTo = $yearTo;
             
        if (($yearFrom !== "") & ($yearTo !== "")) {
            array_push($solrSafeQueryFieldsArray, "(year: %Lx%)");
            array_push($this->solrSafeQueryValuesArray, "[" . $yearFrom . " TO " . $yearTo . "]");
        } else if ($yearFrom !== "") {    
            array_push($solrSafeQueryFieldsArray, "(year: %Lx%)");
            array_push($this->solrSafeQueryValuesArray, "[" . $yearFrom . " TO *]");
        } else if ($yearTo !== "") {
            array_push($solrSafeQueryFieldsArray, "(year: %Lx%)");
            array_push($this->solrSafeQueryValuesArray, "[* TO " . $yearTo . "]");
        }
        
        $publisher = html_entity_decode($publisher, ENT_QUOTES | ENT_HTML5);
        $this->sanitisedPublisher = $publisher;
        if ($publisher !== "") {
            array_push($solrSafeQueryFieldsArray, "(publisher: %Lx%)");
            array_push($this->solrSafeQueryValuesArray, $publisher);
        }
        
        $placeOfPublication = html_entity_decode($placeOfPublication, ENT_QUOTES | ENT_HTML5);
        $this->sanitisedPlaceOfPublication = $placeOfPublication;
        if ($placeOfPublication !== "") {
            array_push($solrSafeQueryFieldsArray, "(placeOfPublication: %Lx%)");
            array_push($this->solrSafeQueryValuesArray, $placeOfPublication);
        }
        
        if ($this->plaintext) {
            array_push($solrSafeQueryFieldsArray, "(urlPlainText: %Lx%)");
            array_push($this->solrSafeQueryValuesArray, "[* TO *]");
        }
        if ($this->iiif) {
            array_push($solrSafeQueryFieldsArray, "(urlIIIF: %Lx%)");
            array_push($this->solrSafeQueryValuesArray, "[* TO *]");
        }
        if ($this->altoxml) {
            array_push($solrSafeQueryFieldsArray, "(urlALTOXML: %Lx%)");
            array_push($this->solrSafeQueryValuesArray, "[* TO *]");
        }
        if ($this->pdf) {
            array_push($solrSafeQueryFieldsArray, "(urlPDF: %Lx%)");
            array_push($this->solrSafeQueryValuesArray, "[* TO *]");
        }
        if ($this->tei) {
            array_push($solrSafeQueryFieldsArray, "(urlTEI: %Lx%)");
            array_push($this->solrSafeQueryValuesArray, "[* TO *]");
        }
        
        $querystring = "";
        for ($i = 0; $i < count($solrSafeQueryFieldsArray); $i++) {
            if ($i > 0) {
                $querystring .= " AND ";
            }
            $querystring .= str_replace("x%", ($i + 1) . "%", $solrSafeQueryFieldsArray[$i]);          
        }
        $this->solrSafeQuery = $querystring;
    }

    function applyQuery(Query &$query) {
        $query->setQuery($this->solrSafeQuery, $this->solrSafeQueryValuesArray);
    }
    
    function getSolrQuery() : String{
        $client = new Client();
        $query = $client->createSelect();
        $query->setQuery($this->solrSafeQuery, $this->solrSafeQueryValuesArray);
        
        return "q=" . urlencode($query->getQuery());
    }
    
    function getQuery() : String{
        return $this->getPlainQuery();
    }

    function getPlainQuery() : String{
        return "advanced=true" .
               "&title=" . $this->sanitisedTitle . 
               "&creator=" . $this->sanitisedCreator . 
               "&yearfrom=" . $this->sanitisedYearFrom .
               "&yearto=" . $this->sanitisedYearTo .
               "&publisher=" . $this->sanitisedPublisher .
               "&placeofpublication=" . $this->sanitisedPlaceOfPublication .
               "&plaintext=" . $this->sanitisedPlainText .
               "&iiif=" . $this->sanitisedIIIF . 
               "&altoxml=" . $this->sanitisedAltoXML . 
               "&pdf=" . $this->sanitisedPDF . 
               "&tei=" . $this->sanitisedTEI;
    }
}