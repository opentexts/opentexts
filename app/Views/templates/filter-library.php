<div class="card">
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
