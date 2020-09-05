<?php
/** @var string $title */
/** @var string $q */
/** @var integer $resultcount */
/** @var Solarium\Component\Result\Facet\FacetResultInterface $organisationfacet */
/** @var Solarium\Component\Result\Facet\FacetResultInterface $languagefacet */
/** @var Solarium\Component\Result\Highlighting\Highlighting $highlighted */
/** @var  Solarium\Core\Query\Result\ResultInterface|Solarium\QueryType\Select\Result\Result $results */
/** @var  string $selectedorganisation */
/** @var  string $organisation */
/** @var  string $selectedlanguage */
/** @var  string $language */
/** @var  integer $start */
/** @var  integer $count */
/** @var  integer $lastpage */
/** @var  string $url */
/** @var  string $exporturl */
?>
<div class="container mx-auto max-w-xl mb-8">
    <form class="flex">
        <input type="hidden" name="q" value="<?= esc($q) ?>"/>
        <?php
        include('filter-generic.php');
        render_facetset("organisation", $organisation, "All libraries", "Multiple libraries", $organisationfacet);
        render_facetset("language", $language, "All languages", "Multiple languages", $languagefacet);
        ?>
    </form>
</div>

<div>
<template id="result" data-payload="<?=   esc(json_encode($payload));  ?>">
    <div class="container mx-auto max-w-xl mb-8">

        <!-- Title -->
        <h2 class="text-darkCyan text-xl leading-tight mb-1">
            <a rel="bookmark"></a>
        </h2>

        <!-- Author -->
        <span class="text-slate"></span>


        <!-- Publication Information -->
        <span class="text-slate text-opacity-75">
            <!-- Publisher -->
            <!-- Place of publication -->
            <!-- Year of publication -->
        </span>

        <!-- Icons for different formats -->
        <div class="inline-flex space-x-1">
            <a><img src="/images/pdf.png" height="16" width="16" alt="PDF version of this item" /></a>
            <a><img src="/images/logo-iiif-34x30.png" height="16" width="16" alt="IIIF manifest for this item" /></a>
            <a><img src="/images/txt.png" height="16" width="16" alt="Plain text version of this item" /></a>
            <a><img src="/images/alto-xml.png" height="16" width="16" alt="ALTO XML version of this item" /></a>
            <a><img src="/images/other.png" height="16" width="16" alt="Alternative version of this item" /></a>
        </div>

    </div>

</template>
    <script type="module" src="./scripts/search-results.js"></script>
</div>

<?php
    // Show the search footer, which loads more results and allows users to export their results.
    include('search-footer.php');
?>