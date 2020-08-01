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
