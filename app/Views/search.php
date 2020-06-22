<main role="main" class="container">
    <h1 class="mt-5">Search Results</h1>
 
    <form action="search" method="GET">
        <p align="center">        
            <input type="text" name="q" value="<?= esc($q); ?>" /> <button type=button">Search</button>
        </p>    
    </form>
    
    <div class="row">
       
        <div class="col-md-4">
            
            <div class="card">
                <div class="card-header bg-info text-white">
                    Source
                </div>
                <ul class="list-group list-group-flush">   
                <?php
                    // Organisation facet counts
                    foreach ($organisationfacet as $value => $count) {
                        if ($count > 0) {
                            ?><li class="list-group-item"><a href="/search/?q=<?= esc($q); ?>&organisation=<?= esc($value); ?><?php 
                                    if (!empty($language)) { echo "&language=" . $language; }
                                ?>"><?= esc($value); ?></a>
                                <span class="badge badge-pill badge-primary" style="float: right"><?= esc($count); ?></span> <?php
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
            
            <p/>
            
            <div class="card">
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
                                <span class="badge badge-pill badge-primary" style="float: right"><?= esc($count); ?></span> <?php
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
            ?><div class="alert alert-warning">There were <?= esc($resultcount); ?> records found</div><?php  
        } else if ($resultcount == 1) {
            ?><div class="alert alert-info">There was <?= esc($resultcount); ?> record found:</div><?php 
        } else {
            ?><div class="alert alert-info">There were <?= esc($resultcount); ?> records found:</div><?php
        }
    ?>

    <?php
        // Results
        foreach ($results as $document) {
            ?><p>
                <?php if (!empty($document->urlMain)) {?>
                    <b><a href='<?= esc($document->urlMain); ?>'><?= esc($document->title); ?></a></b>
                <?php } else { ?>
                    <b><?= esc($document->title); ?></b> <font color="red">(No URL provided)</font>
                <?php } ?>
                <br />
                <?php if (!empty($document->creator[0])) {
                    foreach ($document->creator as $creator) { ?>
                        <?= esc($creator); ?>
                    <?php } ?>
                <?php } else { ?>
                    <i>Creator not listed, </i>
                <?php } ?>
                <?php if (!empty($document->year)) {?>
                    <?= esc($document->year); ?>
                <?php } ?>
                <?php if (!empty($document->publisher[0])) { ?> (<?php
                    foreach ($document->publisher as $publisher) {
                        print($publisher); 
                }?>)<?php } ?>
                <?php if (!empty($document->placeOfPublication[0])) { ?> (<?php
                    foreach ($document->placeOfPublication as $placeOfPublication) {
                        print($placeOfPublication);
                }?>)<?php } ?>
                <br />
                <?php if (!empty($document->topic[0])) {
                    foreach ($document->topic as $topic) {?>
                    <span class="badge badge-light">Topic: <?= esc($topic); ?></span>
                <?php }?><br /><?php } ?>
                <?php if (!empty($document->description[0])) {
                    foreach ($document->description as $description) {?>
                    <span class="badge badge-light">Description: <?= esc($description); ?></span>
                <?php }?><br /><?php } ?>
                <span class="badge badge-primary">Source: <?= esc($document->organisation); ?></span>
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