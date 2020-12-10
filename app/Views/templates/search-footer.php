<footer class="container mx-auto py-8 flex flex-col items-center justify-center space-y-2">

    <button class="button-primary load-more-results<?php if ($count >= $resultcount) echo " invisible"; ?>">More results</button>

    <p class="text-gray-600"><span id="resultCount" class="font-semibold"><?= $start+1 ?>-<?= $count ?></span> of <span id="resultTotal" class="font-semibold"><?= number_format($resultcount); ?></span> results.</p>

    <p class="link">Download full results as: <a href="<?= esc($exporturl) ?>" rel="nofollow" id="exportcsv">CSV</a>, <a href="<?= esc($exporturl) . "&format=xml" ?>" rel="nofollow" id="exportxml">XML</a>, <a href="<?= esc($exporturl) . "&format=json" ?>" rel="nofollow" id="exportjson">JSON</a></p>
</footer>
