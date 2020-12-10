<?php
namespace App\Models;

use Solarium\QueryType\Select\Query\Query;

class EContext {
    const GLOBAL = 0;
    const QUOTES = 1;
}
const FUZZY_SEARCH_ENABLED = false;
class OTQuery
{
    public $isValid = true;
    public $sanitisedQuery = "";
    private $solrSafeQuery = "";

    function __construct() {
        $q = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty($q)) $q = "";
        
        $q = html_entity_decode($q, ENT_QUOTES | ENT_HTML5);
        $this->sanitisedQuery = $q;

        $q = urldecode($q);
        $chars = str_split($q);
        $context = EContext::GLOBAL;

        $term = array();
        $mandatoryFlag = false;
        $notIncludeFlag = false;
        $endTermFlag = false;
        $enterQuoteContext = false;
        $exitQuoteContext = false;
        foreach ($chars as $char){
            switch($char)
            {
                case "\"":
                    if(count($term) > 0) {
                        $endTermFlag = true;
                    }
                    if($context == EContext::GLOBAL) {
                        $enterQuoteContext = true;
                    } else {
                        $exitQuoteContext = true;
                    }
                    break;
                case "+":
                    if(count($term) == 0) {
                        $mandatoryFlag = true;
                    } else {
                        $endTermFlag = true;
                    }
                    break;
                case "-":
                case "!":
                    if(count($term) == 0) {
                        $notIncludeFlag = true;
                    } else {
                        $endTermFlag = true;
                    }
                    break;
                case " ":
                    if($context == EContext::GLOBAL) {
                        $endTermFlag = true;
                    } else {
                        array_push($term, $char);
                    }
                case "&":   // No search relevance
                case "|":
                case "^":
                    break;
                case "(":   // Escape character and proceed
                case ")":
                case "[":
                case "]":
                case "{":
                case "}":
                case "~":
                case "*":
                case "?":
                case ":":
                case "/":
                    array_push($term, "\\", $char);
                    break;
                default:
                    array_push($term, $char);
                    break;
            }
            if($exitQuoteContext) {
                $context = EContext::GLOBAL;
                $exitQuoteContext = false;
            }
            if($endTermFlag && $context != EContext::QUOTES) {
                $this->solrSafeQuery .= $this->buildQueryPart($term, $mandatoryFlag, $notIncludeFlag);
                $term = array();
                $endTermFlag = false;
                $mandatoryFlag = false;
                $notIncludeFlag = false;
            }
            if($enterQuoteContext) {
                $context = EContext::QUOTES;
                $enterQuoteContext = false;
                if(!$notIncludeFlag) {
                    $mandatoryFlag = true; // Quotes are implicitly mandatory unless expressly countered
                }
            }
        }
        $this->solrSafeQuery .= $this->buildQueryPart($term, $mandatoryFlag, $notIncludeFlag);

        if ((empty($this->solrSafeQuery)) || (trim($this->solrSafeQuery) == "")) {
            $this->solrSafeQuery = "*";
        }
        if (getenv('CI_ENVIRONMENT') !== 'production') {
            $log = fopen("../writable/query.log", "a");
            fwrite($log, $this->sanitisedQuery . " -> " . $this->solrSafeQuery . "\n");
            fclose($log);
        }
    }

    function buildQueryPart(Array $term, bool $mustInclude, bool $mustNotInclude) : string {
        $finalTerm = implode($term);
        $multiWord = str_contains($finalTerm, " ");
        $expr = "";
        $lcase = strtolower($finalTerm);
        $fuzzy = FUZZY_SEARCH_ENABLED && strlen($finalTerm) > 5 && !$mustInclude && !$mustNotInclude;
        if($lcase == "and" || $lcase == "or") {
            return $expr;
        }
        if ($fuzzy){
            return "(" . $finalTerm . "^2 OR " . $finalTerm . "~) ";
        }
        if($mustInclude) {
            $expr .= "+";
        } else if($mustNotInclude) {
            $expr .= "-";
        }
        if($multiWord) {
            $expr .= "\"";
        }
        $expr .= $finalTerm;
        if($multiWord) {
            $expr .= "\"";
        }
        $expr .= " ";
        return $expr;
    }

    function applyQuery(Query &$query) {
        $query->setQuery($this->solrSafeQuery);
    }

    function getSolrQuery() : String{
        return 'q=' . trim($this->solrSafeQuery);    
    }

    function getQuery() : String{
        return "q=" . $this->solrSafeQuery;
    }

    function getPlainQuery() : String{
        return $this->sanitisedQuery;
    }
}