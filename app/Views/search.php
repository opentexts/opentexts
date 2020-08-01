<main role="main" class="container bg-white w-screen max-w-none">
    <h1 class="mt-5">Search Results</h1>
    
    <div class="row">
       
        <div class="col-md-4">
            
            <div class="card" style="display: none">
                <div class="card-header bg-info text-white">
                    Library
                </div>
                <ul class="list-group list-group-flush">   
                <?php
                    // Organisation facet counts
                    $facetarray = $organisationfacet->getValues(); 
                    ksort($facetarray);
                    foreach ($facetarray as $value => $count) {
                        if ($count > 0) {
                            ?><li class="list-group-item"><a href="/search/?q=<?= esc($q); ?>&organisation=<?= esc($value); ?><?php 
                                    if (!empty($language)) { echo "&language=" . $language; }
                                ?>"><?= esc($value); ?></a>
                                <span class="badge badge-pill badge-primary" style="float: right"><?= number_format($count); ?></span> <?php
                                if (!empty($organisation)) {
                                    ?><a href="/search/?q=<?= esc($q); ?><?php 
                                    if (!empty($language)) { echo "&language=" . $language; }
                                ?>" class="badge badge-pill badge-danger">Remove</a><?php 
                                }
                            ?></li>
                                <?php
                        } 
                    }
                ?>
                </ul>
            </div>
                        
            <div class="card" style="display: none">
                <div class="card-header bg-info text-white">
                    Language
                </div>
                <ul class="list-group list-group-flush">   
                <?php
                    // Language facet counts
                    $langcount = 0;
                    foreach ($languagefacet as $value => $count) {
                        if ($count > 0) {
                            $langcount++;
                            if ($langcount > 10) { ?> <div class="collapse multi-collapse" id="langcollapse"> <?php }
                            ?><li class="list-group-item"><a href="/search/?q=<?= esc($q); ?>&language=<?= esc($value); ?><?php 
                                    if (!empty($organisation)) { echo "&organisation=" . $organisation; }
                                ?>"><?= esc($value); ?></a>
                                <span class="badge badge-pill badge-primary" style="float: right"><?= number_format($count); ?></span> <?php
                                if (!empty($language)) {
                                    ?><a href="/search/?q=<?= esc($q); ?><?php 
                                    if (!empty($organisation)) { echo "&organisation=" . $organisation; }
                                ?>" class="badge badge-pill badge-danger">Remove</a><?php 
                                }
                            ?></li>
                            <?php
                        if ($langcount > 10) { ?> </div> <?php }
                        } 
                    }
                ?>
                </ul>
                <?php 
                    if ($langcount > 10) { ?> 
                        <button class="btn-info" data-toggle="collapse" href="#langcollapse" role="button" aria-expanded="false" aria-controls="langcollapse">Show / hide all</button>
                    <?php }
                ?>
            </div>
        
        </div>
        <div class="col-md-8">
            
    <?php
        // Result count
        if ($resultcount == 0) {
            ?>
                <p class="lead">
                    No results found for <b><?= esc($q); ?></b>
                </p>
                <p>
                    Suggestions:<br />
                    <ul>
                        <li>Make sure all words are spelled correctly.</li>
                        <li>Try different keywords.</li>
                        <li>Try more general keywords.</li>
                        <li>Try fewer keywords.</li>
                    </ul>
                </p>    
            <?php  
        } else if ($resultcount == 1) {
            ?><div class="alert alert-info">
                There was 1 record found:
                <div class="float-right"><a href="<?= esc($exporturl) ?>" rel=“nofollow”>Export results <img src="/images/export.png" height="18px" /></a></div>
            </div><?php 
        } else {
            ?><div class="alert alert-info">
                There were <?= number_format($resultcount); ?> records found:
                <div class="float-right"><a href="<?= esc($exporturl) ?>" rel=“nofollow”>Export results <img src="/images/export.png" height="18px" /></a></div>
            </div><?php
        }
    ?>

    <?php
        // Results
        foreach ($results as $document) {
            // Process highlighting
            $title = $document->title;
            $creators = $document->creator;
            $publishers = $document->publisher;
            $placesOfPublication = $document->placeOfPublication;
            $highlightedDoc = $highlighted->getResult($document->id);
            if ($highlightedDoc) {
                foreach ($highlightedDoc as $field => $highlight) {
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
                }
            }
            ?><p>
                <?php if (!empty($document->urlMain)) {?>
                <div class="lead"><a href='<?= esc($document->urlMain); ?>'><?=  $title; ?></a>
                <?php } else { ?>
                    <b><?= esc($document->title); ?></b> <font color="red">(No URL provided)</font>
                <?php } ?>
                <?php if (!empty($document->urlPDF)) {?>
                    <a href='<?= esc($document->urlPDF); ?>'><img src="/images/pdf.png" height="18" /></a>
                <?php } ?>
                <?php if (!empty($document->urlIIIF)) {?>
                    <a href='<?= esc($document->urlIIIF); ?>'><img src="/images/logo-iiif-34x30.png" height="18" /></a>
                <?php } ?>
                <?php if (!empty($document->urlOther)) {?>
                    <a href='<?= esc($document->urlOther[0]); ?>'><img src="/images/txt.png" height="18" /></a>
                <?php } ?>
                </div>
                <?php if (!empty($document->creator[0])) {
                    foreach ($creators as $creator) { ?>
                        <?= $creator; ?>
                    <?php } ?>
                <?php } else { ?>
                    <i>Creator not listed, </i>
                <?php } ?>
                <?php if (!empty($document->year)) {?>
                    <?= esc($document->year); ?>
                <?php } ?>
                <?php if (!empty($document->publisher[0])) { ?> (<?php
                    foreach ($publishers as $publisher) {
                        print($publisher); 
                }?>)<?php } ?>
                <?php if (!empty($document->placeOfPublication[0])) { ?> (<?php
                    foreach ($placesOfPublication as $placeOfPublication) {
                        print($placeOfPublication);
                }?>)<?php } ?>
                <br />
                <span class="badge badge-primary">Source: <?= esc($document->organisation); ?></span>
                <span class="badge badge-dark">Language: <?= esc($document->language); ?></span>
                <?php if (!empty($document->licence)) {?>
                    <a href='<?= esc($document->licence); ?>' class="badge badge-success">Licence: <?= esc($document->licence); ?></a><br />
                <?php } ?>
                <?php if (!empty($document->catLink)) {?>
                    <a href='<?= esc($document->catLink); ?>' class="badge badge-info">Link: Original catalogue record (ID: <?= esc($document->idLocal); ?>)</a><br />
                <?php } ?>
            </p><?php
        }
    ?>

    <?php
        // Do we ened pagination?
        if ($resultcount > 10) {
            ?>
        
            <nav aria-label="Page navigation example">
                <ul class="pagination">
            
            <?php
            // Do we need to show first page jump link
            if ($start > 10) {
                ?><li class="page-item"><a class="page-link" href='<?= $url; ?>'>
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span></a>
                  </li><?php
            }

            // Do we need to show previous page link?
            if ($start >= 10) {
                ?><li class="page-item"><a class="page-link" href='<?= $url . '&start=' . ($start - 10); ?>'>&lt; Previous page</a></li><?php
            }

            // Do we need to show next page link?
            if ($resultcount > $start + 10) {
                ?><li class="page-item"><a class="page-link" href='<?= $url . '&start=' . ($start + 10); ?>'>Next page &gt;</a></li><?php
            }

            // Do we need to show a last page jump link
            if ($start < ($resultcount - 10)) {
                ?><li class="page-item"><a class="page-link" href='<?= $url . '&start=' . (floor($resultcount / 10) * 10); ?>'>
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Last</span></a>
                  </li><?php
            }
            ?>
                
                </ul>
            </nav>    
                
            <?php
        }
    ?>
        </div>   
</main>
