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
    
    public $santisedQuery = "";
    
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
        
        $solrSafeQueryFieldsArray = array();
        $this->solrSafeQueryValuesArray = array();
        
        $title = html_entity_decode($title, ENT_QUOTES | ENT_HTML5);
        $this->sanitisedTitle = $title;
        if ($title !== "") {
            array_push($solrSafeQueryFieldsArray, "title: %Lx%");
            array_push($this->solrSafeQueryValuesArray, $title);
            $this->sanitisedQuery = $title;
        }
        
        $creator = html_entity_decode($creator, ENT_QUOTES | ENT_HTML5);
        $this->sanitisedCreator = $creator;
        if ($creator !== "") {
            array_push($solrSafeQueryFieldsArray, "creator: %Lx%");
            array_push($this->solrSafeQueryValuesArray, $creator);
            $this->sanitisedQuery .= "-" . $creator;
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
            array_push($solrSafeQueryFieldsArray, "year: %Lx%");
            array_push($this->solrSafeQueryValuesArray, "[" . $yearFrom . " TO " . $yearTo . "]");
        } else if ($yearFrom !== "") {    
            array_push($solrSafeQueryFieldsArray, "year: %Lx%");
            array_push($this->solrSafeQueryValuesArray, "[" . $yearFrom . " TO *]");
        } else if ($yearTo !== "") {
            array_push($solrSafeQueryFieldsArray, "year: %Lx%");
            array_push($this->solrSafeQueryValuesArray, "[* TO " . $yearTo . "]");
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
               "&yearto=" . $this->sanitisedYearTo;;
    }
}