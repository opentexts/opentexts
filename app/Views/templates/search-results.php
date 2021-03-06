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
/** @var  array $payload */
?>
<div class="container mx-auto max-w-xl mb-12">
    <?php if ($advanced != True) { ?>
        <form class="flex">
            <input type="hidden" name="q" value="<?= esc($q) ?>"/>
            <?php
            include('filter-generic.php');
            render_facetset("organisation", $organisation, "libraries", $organisationfacet);
            render_facetset("language", $language, "languages", $languagefacet);
            ?>
        </form>
    <?php } else { ?>
        <h1>Advanced Search</h1>      
        <p><a href="/advanced?<?= esc(substr($url, 9)) ?>">Edit search</a></p>
    <?php } ?>
</div>
<div id="result-skeletons" class="hidden">
    <div class="container mx-auto max-w-xl mb-6 skeleton"></div>
    <div class="container mx-auto max-w-xl mb-6 skeleton"></div>
    <div class="container mx-auto max-w-xl mb-6 skeleton"></div>
    <div class="container mx-auto max-w-xl mb-6 skeleton"></div>
    <div class="container mx-auto max-w-xl mb-6 skeleton"></div>
    <div class="container mx-auto max-w-xl mb-6 skeleton"></div>
</div>
<div>

<template id="result" data-payload="<?=   esc(json_encode($payload));  ?>">
    <div class="container mx-auto max-w-xl mb-8">

        <!-- Title -->
        <h2 class="text-darkCyan text-xl leading-tight mb-2">
            <a class="text-blue-700 hover:text-blue-600 visited:text-blue-800 visited inline-block" rel="bookmark"></a>
            <?php
            if($include_score) {
                ?>
                <span class="text-red-700"></span>
            <?php
            }
            ?>
        </h2>

        <!-- Author -->
        <span class="text-slate"></span>


        <!-- Publication Information -->
        <span class="text-slate text-opacity-75">
            <!-- Publisher -->
            <!-- Place of publication -->
            <!-- Year of publication -->
        </span>

        <!-- Source library -->
        <div class="mt-2 text-gray-600 text-sm">
            National Library of Scotland
        </div>

        <!-- Different formats for download -->
        <div class="flex flex-wrap items-baseline space-x-1 text-gray-600 text-sm">
            <span>Download:</span>
            <a class="text-gray-600"><span class="sr-only">Download </span>PDF<span class="sr-only"> of {ARTICLE_TITLE}.</span></a>
            <a class="text-gray-600"><span class="sr-only">Download </span>IIIF<span class="sr-only"> of {ARTICLE_TITLE}.</span></a>
            <a class="text-gray-600"><span class="sr-only">Download </span>Plain-text<span class="sr-only"> of {ARTICLE_TITLE}.</span></a>
            <a class="text-gray-600"><span class="sr-only">Download </span>ALTO XML<span class="sr-only"> of {ARTICLE_TITLE}.</span></a>
            <a class="text-gray-600"><span class="sr-only">Download </span>TEI<span class="sr-only"> of {ARTICLE_TITLE}.</span></a>
            <a class="text-gray-600"><span class="sr-only">Download </span>Other format<span class="sr-only"> of {ARTICLE_TITLE}.</span></a>
        </div>
    </div>

</template>
    <script type="module" src="./scripts/search-results.js"></script>
    <script>
        document.querySelectorAll(".filter").forEach(function(filter){
            filter.addEventListener('click', function(event){
                this.classList.add('filter-focus');
            })
            filter.addEventListener('keydown', function(event){
                if(!this.classList.contains('filter-focus'))
                {
                    if(event.keyCode === 13 || event.keyCode === 32) {
                        this.classList.add('filter-focus');
                        this.querySelector("li[tabindex]").focus();
                        event.preventDefault();
                    }
                }
                else
                {
                    switch(event.keyCode)
                    {
                        case 27:
                            this.classList.remove('filter-focus')
                            this.focus();
                            event.preventDefault();
                            break;
                        case 38:
                            document.activeElement.previousElementSibling.focus();
                            event.preventDefault();
                            break;
                        case 40:
                            document.activeElement.nextElementSibling.focus();
                            event.preventDefault();
                            break;
                        case 13:
                            document.activeElement.querySelector("a").click();
                            event.preventDefault();
                    }
                }

            })
        })

    </script>
</div>

<?php
    // Show the search footer, which loads more results and allows users to export their results.
    include('search-footer.php');
?>
