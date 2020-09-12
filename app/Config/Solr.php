<?php namespace Config;

use CodeIgniter\Config\BaseConfig;

class Solr extends BaseConfig
{
    public $solarium = array(
        'endpoint' => array(
            'localhost' => array(
                'host' => 'solr.opentexts.world',
                'port' => 80,
                'path' => '/',
                'core' => 'otw-v2'
            )
        )
    );
    
    // The timeout (in seconds) for solr queries to complete
    public $solariumTimeout = 10;
}