<main role="main" class="container bg-white w-screen max-w-none">

    <h1 class="sr-only">Search results for <?php echo(esc($q)); ?></h2>
            
    <?php
        if ($resultcount == 0) {
            include('templates/no-results.php');
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

        <?php include('templates/search-footer.php'); ?>
        </div>   
</main>
