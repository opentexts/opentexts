<main role="main" class="container">
    <h1 class="mt-5">Search Results</h1>

    <form action="search" method="GET">
        <p align="center">        
            <input type="text" name="q" value="<?= esc($q); ?>" /> <button type=button">Search</button>
        </p>    
    </form>

    
    <div class="row">
       
        <div class="col-md-4">
            
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Source</h3>
                </div>
                <div class="panel-body">   
                <?php
                    // Collection facet counts
                    foreach ($collectionfacet as $value => $count) {
                        if ($count > 0) {
                            ?><p><a href="/search/?q=<?= esc($q); ?>&collection=<?= esc($value); ?>"><?= esc($value); ?></a> <span class="badge" style="float: right;"><span class="badge badge-pill badge-primary"><?= esc($count); ?></span> <?php
                                if (!empty($collection)) {
                                    ?><a href="/search/?q=<?= esc($q); ?>" class="badge badge-danger">Remove</a><?php 
                                }
                            ?></span></p><?php
                        }
                    }
                ?>
                </div>
            </div>
        
        </div>
        <div class="col-md-8">
            
    <?php
        // Result count
        if ($resultcount == 0) {
            ?><div class="alert alert-success">There were <?= esc($resultcount); ?> records found</div><?php  
        } else if ($resultcount == 1) {
            ?><div class="alert alert-success">There was <?= esc($resultcount); ?> record found:</div><?php 
        } else {
            ?><div class="alert alert-success">There were <?= esc($resultcount); ?> records found:</div><?php
        }
    ?>

    <?php
        // Results
        foreach ($results as $document) {
            ?><p>
                <?php if (!empty($document->url)) {?>
                    <b><a href='<?= esc($document->url); ?>'><?= esc($document->title); ?></a></b>
                <?php } else { ?>
                    <b><?= esc($document->title); ?></b> <font color="red">(No URL provided)</font>
                <?php } ?>
                <?php if (!empty($document->creator)) {?>
                    (<?= esc($document->creator); ?>)<br />
                <?php } else { ?>
                    <i>(Creator not listed)</i><br />
                <?php } ?>    
                Source: <?= esc($document->collection); ?> <br />
                <?php if (!empty($document->url)) {?>
                    <a href='<?= esc($document->url); ?>'><?= esc($document->url); ?></a>
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