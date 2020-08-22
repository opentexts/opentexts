<footer role="footer" class="container mx-auto py-8 flex flex-col items-center justify-center space-y-2">

<?php
// If we still have more results, show a "Load more" button
?>
<button class="py-3 px-10 rounded-md bg-cobalt text-offWhite load-more-results">More results</button>

<span class="text-slate">[<span id="resultCount"><?= $start+1 ?>-<?= $count ?></span>] of <?= number_format($resultcount); ?> results.</span>

<a class="text-darkCyan underline" href="<?= esc($exporturl) ?>" rel=“nofollow”>Download full results.</a>
</footer>
