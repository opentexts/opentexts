<footer role="footer" class="container mx-auto py-8 flex flex-col items-center justify-center space-y-2">

<button class="button-primary load-more-results<?php if ($count >= $resultcount) echo " invisible"; ?>">More results</button>

    <span class="text-gray-700">[<span id="resultCount"><?= $start+1 ?>-<?= $count ?></span>] of <span id="resultTotal"><?= number_format($resultcount); ?></span> results.</span>

<a class="link" href="<?= esc($exporturl) ?>" rel=“nofollow”>Download full results.</a>
</footer>
