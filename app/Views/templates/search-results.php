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
<div class="container mx-auto max-w-xl mb-8">
    <form class="flex">
        <input type="hidden" name="q" value="<?= esc($q) ?>"/>
        <?php
        include('filter-generic.php');
        render_facetset("organisation", $organisation, "libraries", $organisationfacet);
        render_facetset("language", $language, "languages", $languagefacet);
        ?>
    </form>
</div>
<div id="result-skeletons" class="hidden">
    <div class="container mx-auto p-4 mb-8 skeleton"></div>
    <div class="container mx-auto p-4 mb-8 skeleton"></div>
    <div class="container mx-auto p-4 mb-8 skeleton"></div>
    <div class="container mx-auto p-4 mb-8 skeleton"></div>
    <div class="container mx-auto p-4 mb-8 skeleton"></div>
    <div class="container mx-auto p-4 mb-8 skeleton"></div>
</div>
<div>

<template id="result" data-payload="<?=   esc(json_encode($payload));  ?>">
    <div class="container mx-auto max-w-xl mb-8">

        <!-- Title -->
        <h2 class="text-darkCyan text-xl leading-tight mb-1">
            <a class="text-blue-700 hover:text-blue-600" rel="bookmark"></a>
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
            <a><img src="/images/pdf.png" height="16" width="16" /></a>
            <a><img src="/images/logo-iiif-34x30.png" height="16" width="16" /></a>
            <a><img src="/images/txt.png" height="16" width="16" /></a>
        </div>

    </div>

</template>
    <script type="module" src="./scripts/search-results.js"></script>
    <script>
        document.querySelectorAll(".filter").forEach(function(filter){
            filter.addEventListener('click', function()
            {
                if(!this.classList.contains('filter-focus')) {
                    this.classList.add('filter-focus');
                }
            }, true);

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

            filter.addEventListener('blur',  function(){
                setTimeout(function(){
                    if(!this.contains(document.activeElement)) {
                        this.classList.remove('filter-focus')
                    }
                }.bind(this),0)
            }, true)
        })

    </script>
</div>
<?php


// Show the search footer, which loads more results and allows users to export their results.
include('search-footer.php');
?>