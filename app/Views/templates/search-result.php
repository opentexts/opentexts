<div class="container mx-auto max-w-xl mb-8">
    
    <!-- Title -->
    <h2 class="text-darkCyan text-xl leading-tight mb-1">
        <?php if ( $document->urlMain ) {
            printf( '<a href="%1$s" rel="bookmark">%2$s</a>',
                esc( $document->urlMain ),
                $title
        );
        } else {
            echo $title; 
        }
        ?>
    </h2>

    <!-- Author -->
    <span class="text-slate">
    <?php if (!empty($document->creator[0])) {
        foreach ($creators as $creator) {
            echo $creator;
        }
    } ?>
    </span>


    <!-- Publication Information -->
    <span class="text-slate text-opacity-75">

    <?php 
    // Publisher(s)
    if (!empty($document->publisher[0])) {
        foreach ($publishers as $publisher) {
            echo($publisher); 
            echo(' ');            
        }
    }

    // Place of publication
    if (!empty($document->placeOfPublication[0])) { 
        foreach ($placesOfPublication as $placeOfPublication) {
            echo($placeOfPublication);
            echo(' ');
        }
    }

    // Year of publication
    if (!empty($document->year)) {
        echo(esc($document->year));
    }
    ?>
    </span>
    
    <!-- Icons for different formats -->
    <div class="inline-flex space-x-1">
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
