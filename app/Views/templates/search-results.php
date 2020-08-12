<div class="card">
    <form>
        <input type="hidden" name="q" value="<?= $q ?>"/>
        <?php
        include('filter-generic.php');
        render_facetset("Library","organisation", $organisation, $organisationfacet);
        render_facetset("Language", "language", $language, $languagefacet);
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
