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
        
</section>