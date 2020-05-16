<!-- CONTENT -->
<section>
    <h1>Search results</h1>

    <form action="search" method="GET">
        <p align="center">        
            <input type="text" name="q" value="<?= esc($q); ?>" /> <button type=button">Search</button>
        </p>    
    </form>

    <p style="background-color:#f2f2f2;">
        <?php
            // Collection facet counts
            foreach ($collectionfacet as $value => $count) {
                if ($count > 0) {
                    ?><a href="/search/?q=<?= esc($q); ?>&collection=<?= esc($value); ?>"><?= esc($value); ?></a> [<?= esc($count); ?>] <?php
                        if (!empty($collection)) {
                            ?><a href="/search/?q=<?= esc($q); ?>">(remove)</a><?php 
                        }
                    ?><br/><?php
                }
            }
        ?>
    </p>

    <?php
        // Result count
        if ($resultcount == 0) {
            ?><p>There were <?= esc($resultcount); ?> records found</p><?php  
        } else if ($resultcount == 1) {
            ?><p>There was <?= esc($resultcount); ?> record found:</p><?php 
        } else {
            ?><p>There were <?= esc($resultcount); ?> records found:</p><?php
        }

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
                Source: <?= esc($document->collection); ?> 
            </p><?php
        }
    ?>

    <?php
        // Do we need to show first page jump link
        if ($start > 10) {
            ?><a href='<?= $url; ?>'>&lt;&lt;</a>&nbsp;&nbsp;&nbsp;&nbsp;<?php
        }

        // Do we need to show previous page link?
        if ($start >= 10) {
            ?><a href='<?= $url . '&start=' . ($start - 10); ?>'>&lt; Previous page</a>&nbsp;&nbsp;&nbsp;&nbsp;<?php
        }
        
        // Do we need to show next page link?
        if ($resultcount > $start + 10) {
            ?><a href='<?= $url . '&start=' . ($start + 10); ?>'>Next page &gt;</a>&nbsp;&nbsp;&nbsp;&nbsp;<?php
        }
        
        // Do we need to show a last page jump link
        if ($start < ($resultcount - 10)) {
            ?><a href='<?= $url . '&start=' . (floor($resultcount / 10) * 10); ?>'>&gt;&gt;</a><?php
        }
    ?>
        
</section>