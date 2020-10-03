<footer class="container mx-auto py-8 flex flex-col items-center justify-center space-y-2">

    <button class="button-primary load-more-results<?php if ($count >= $resultcount) echo " invisible"; ?>">More results</button>

    <p class="text-gray-600"><span id="resultCount" class="font-semibold"><?= $start+1 ?>-<?= $count ?></span> of <span id="resultTotal" class="font-semibold"><?= number_format($resultcount); ?></span> results.</p>

    <a class="link" id="export" href="<?= esc($exporturl) ?>" rel=“nofollow”>Download full results.</a>
</footer>
