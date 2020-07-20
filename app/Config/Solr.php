<?php namespace Config;

use CodeIgniter\Config\BaseConfig;

class Solr extends BaseConfig
{
    public $solarium = array(
        'endpoint' => array(
            'localhost' => array(
                'host' => 'opentexts.world',
                'port' => 8983,
                'path' => '/',
                'core' => 'otw'
            )
        )
    );
}