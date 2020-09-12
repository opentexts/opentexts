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
    
    public function __construct() {
        if (getenv('CI_ENVIRONMENT') == 'production') {
            $this->solarium = array(
                'endpoint' => array(
                    'localhost' => array(
                        'host' => 'solr.opentexts.world',
                        'port' => 8983,
                        'path' => '/',
                        'core' => 'otw-v2'
                    )
                )
            );
        }
    }
}