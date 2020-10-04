<?php


namespace App\Models;


class SuggestedSearch
{
    public $label;
    public $icon;
    public $searchUrl;
    function __construct(string $label, string $icon, string $searchTerm) {
        $this->label = $label;
        $this->icon = $icon;
        $this->searchUrl = urlencode($searchTerm);
    }
}