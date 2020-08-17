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
                'core' => 'otw'
            )
        )
    );
}