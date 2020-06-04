<?php namespace Config;

use CodeIgniter\Config\BaseConfig;

class Solr extends BaseConfig
{
    public $solarium = array(
        'endpoint' => array(
            'localhost' => array(
                'host' => 'gdd.zone',
                'port' => 8983,
                'path' => '/',
                'core' => 'otw'
            )
        )
    );
}