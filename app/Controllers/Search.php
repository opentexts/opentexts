<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Search extends Controller
{
    public function index()
    {
        $data['title'] = "Solarium";
        
        echo view('templates/header', $data); 
        echo view('search');
        
        $config = config('Solr');        
        
        // TODO Make much more robust
        $query = $this->request->uri->getQuery();
        $q = substr($query, 2);
        
        // create a client instance
        $client = new \Solarium\Client($config->solarium);

        // get a select query instance
        $query = $client->createSelect();
        $query->setQuery($q);

        // get the facetset component
        $facetSet = $query->getFacetSet();

        // create a facet field instance and set options
        $facetSet->createFacetField('collection_facet')->setField('collection_facet');

        // this executes the query and returns the result
        $resultset = $client->select($query);

        // display the total number of documents found by solr
        echo 'NumFound: '.$resultset->getNumFound();

        // display facet counts
        echo '<hr/>Facet counts for field "collection_facet":<br/>';
        $facet = $resultset->getFacetSet()->getFacet('collection_facet');
        foreach ($facet as $value => $count) {
            echo $value . ' [' . $count . ']<br/>';
        }

        // show documents using the resultset iterator
        foreach ($resultset as $document) {

            echo '<hr/><table>';
            echo '<tr><th>id</th><td>' . $document->id . '</td></tr>';
            echo '<tr><th>name</th><td>' . $document->title . '</td></tr>';
            echo '<tr><th>creator</th><td>' . $document->creator . '</td></tr>';
            echo '<tr><th>collection</th><td>' . $document->collection . '</td></tr>';
            echo '<tr><th>link</th><td><a href="' . $document->url . '">' . $document->url . '</a></td></tr>';
            echo '</table>';
        }

        echo view('templates/footer');
    }

    //--------------------------------------------------------------------

}
