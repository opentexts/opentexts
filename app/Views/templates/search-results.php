
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
            <a><img src="/images/pdf.png" height="16" width="16" /></a>
            <a><img src="/images/logo-iiif-34x30.png" height="16" width="16" /></a>
            <a><img src="/images/txt.png" height="16" width="16" /></a>
        </div>

    </div>

</template>
    <script type="module" src="./scripts/search-results.js"></script>
</div>
<?php


// Show the search footer, which loads more results and allows users to export their results.
include('search-footer.php');
?>