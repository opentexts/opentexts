<!-- CONTENT -->
<section>
	<h1>Search results</h1>
        
        <form action="search" method="GET">
            <p align="center">        
                <input type="text" name="q" value="<?= esc($q); ?>" /> <button type=button">Search</button>
            </p>    
        </form>

        <?php
            // Collection facet counts
            foreach ($collectionfacet as $value => $count) {
                if ($count > 0) {
                    ?><a href="/search/?q=<?= esc($q); ?>&collection=<?= esc($value); ?>"><?= esc($value); ?></a> [<?= esc($count); ?>]<br/><?php
                }
            }

            // Results
            ?><p>There were <?= esc($resultcount); ?> records found:</p><?php
            foreach ($results as $document) {
                ?><p>
                    <?php if (!empty($document->url)) {?>
                        <b><a href='<?= esc($document->url); ?>'><?= esc($document->title); ?></a></b>
                    <?php } else { ?>
                        <b><?= esc($document->title); ?></b> <font color="red">(No URL provided)</font>
                    <?php } ?>
                    (<?= esc($document->creator); ?>)<br />
                    Source: <?= esc($document->collection); ?> 
                </p><?php
            }
        ?>
        
</section>