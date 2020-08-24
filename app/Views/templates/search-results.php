<?php
/** @var string $title */
/** @var string $q */
/** @var integer $resultcount */
/** @var Solarium\Component\Result\Facet\FacetResultInterface $organisationfacet */
/** @var Solarium\Component\Result\Facet\FacetResultInterface $languagefacet */
/** @var Solarium\Component\Result\Highlighting\Highlighting $highlighted */
/** @var  Solarium\Core\Query\Result\ResultInterface|Solarium\QueryType\Select\Result\Result $results */
/** @var  string $selectedorganisation */
/** @var  string $organisation */
/** @var  string $selectedlanguage */
/** @var  string $language */
/** @var  integer $start */
/** @var  integer $count */
/** @var  integer $lastpage */
/** @var  string $url */
/** @var  string $exporturl */
?>
<div class="container mx-auto max-w-xl mb-8">
    <form class="flex">
        <input type="hidden" name="q" value="<?= $q ?>"/>
        <?php
        include('filter-generic.php');
        render_facetset("organisation", $organisation, "All libraries", "Multiple libraries", $organisationfacet);
        render_facetset("language", $language, "All languages", "Multiple languages", $languagefacet);
        ?>
    </form>
</div>
<?php
foreach ($results as $document) :
    // Highlight search terms in results
    $title = $document->title;
    $creators = $document->creator;
    $publishers = $document->publisher;
    $placesOfPublication = $document->placeOfPublication;
    $highlightedDoc = $highlighted->getResult($document->id);
    
    if ($highlightedDoc) :
        foreach ($highlightedDoc as $field => $highlight):
            if ($field == "title") $title = $highlight[0];
            if ($field == "creator") {
                $creators = array();
                foreach ($highlight as $each) {
                    array_push($creators, $each);
                }
            }
            if ($field == "publisher") {
                $publishers = array();
                foreach ($highlight as $each) {
                    array_push($publishers, $each);
                }
            }
            if ($field == "placeOfPublication") {
                $placesOfPublication = array();
                foreach ($highlight as $each) {
                    array_push($placesOfPublication, $each);
                }
            }
        endforeach;
    endif;
    
    // Show each individual record
    include('search-result.php'); 

endforeach;

// Show the search footer, which loads more results and allows users to export their results.
include('search-footer.php');
