<div class="container mx-auto max-w-xl mb-12">
    
    <!-- Title -->
    <h2 class="text-darkCyan text-xl leading-tight mb-1">
        <?php if ( $document->urlMain ) {
            printf( '<a class="" href="%1$s" rel="bookmark">%2$s</a>',
                esc( $document->urlMain ),
                $title
        );
        } else {
            echo $title; 
        }
        ?>
    </h2>

    <!-- Author -->
    <p class="text-slate text-lg">
    <?php if (!empty($document->creator[0])) {
        foreach ($creators as $creator) {
            echo $creator;
        }
    } ?>
    </p>


    <!-- Publication Information -->
    <p class="text-slate text-opacity-75">

    <?php 
    // Publisher(s), followed by comma
    if (!empty($document->publisher[0])) {
        foreach ($publishers as $publisher) {
            echo($publisher); 
            echo(' ');            
        }
    }

    // Place of publication, followed by comma
    if (!empty($document->placeOfPublication[0])) { 
        foreach ($placesOfPublication as $placeOfPublication) {
            echo($placeOfPublication);
            echo(' ');
        }
    }

    // Year of publication, followed by full stop.
    if (!empty($document->year)) {
        echo(esc($document->year));
        echo('.');
    }
    ?>
    </p>

    <!-- Extra noise that may not provide user value. -->
    <div class="hidden">
        <span class="badge badge-primary">Source: <?= esc($document->organisation); ?></span>
        <span class="badge badge-dark">Language: <?= esc($document->language); ?></span>
        <?php if (!empty($document->licence)) {?>
            <a href='<?= esc($document->licence); ?>' class="badge badge-success">Licence: <?= esc($document->licence); ?></a><br />
        <?php } ?>
        <?php if (!empty($document->catLink)) {?>
            <a href='<?= esc($document->catLink); ?>' class="badge badge-info">Link: Original catalogue record (ID: <?= esc($document->idLocal); ?>)</a><br />
        <?php } ?>
    </div>

    
    <!-- Icons for different formats -->
    <div class="flex space-x-1 mt-1">
        <?php if (!empty($document->urlPDF)) {?>
            <a href='<?= esc($document->urlPDF); ?>'><img src="/images/pdf.png" height="16" width="16" /></a>
        <?php } ?>
        <?php if (!empty($document->urlIIIF)) {?>
            <a href='<?= esc($document->urlIIIF); ?>'><img src="/images/logo-iiif-34x30.png" height="16" width="16" /></a>
        <?php } ?>
        <?php if (!empty($document->urlOther)) {?>
            <a href='<?= esc($document->urlOther[0]); ?>'><img src="/images/txt.png" height="16" width="16" /></a>
        <?php } ?>
    </div>

</div>
