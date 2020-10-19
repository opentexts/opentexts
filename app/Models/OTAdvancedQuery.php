<?php
namespace App\Models;

use Solarium\QueryType\Select\Query\Query;

class OTAdvancedQuery
{
    public $sanitisedTitle = "";
    public $sanitisedCreator = "";
    public $sanitisedYearFrom = "";
    public $sanitisedYearTo = "";
    
    private $solrSafeQuery;
    private $solrSafeQueryValuesArray;

    function __construct(string $title, string $creator, string $yearFrom, string $yearTo) {

        $solrSafeQueryFieldsArray = array();
        $this->solrSafeQueryValuesArray = array();
        
        $title = html_entity_decode($title, ENT_QUOTES | ENT_HTML5);
        $this->sanitisedTitle = $title;
        if ($title !== "") {
            array_push($solrSafeQueryFieldsArray, "title: %Px%");
            array_push($this->solrSafeQueryValuesArray, $title);
        }
        
        $creator = html_entity_decode($creator, ENT_QUOTES | ENT_HTML5);
        $this->sanitisedCreator = $creator;
        if ($creator !== "") {
            array_push($solrSafeQueryFieldsArray, "creator: %Px%");
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

    function getQuery() : String{
        return "title=" . $this->sanitisedTitle . 
               "&creator=" . $this->sanitisedCreator . 
               "&yearfrom=" . $this->sanitisedYearFrom .
               "&yearto=" . $this->sanitisedYearTo;
    }

    function getPlainQuery() : String{
        return "";
    }
}