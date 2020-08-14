<footer role="footer" class="container mx-auto py-8 flex flex-col items-center justify-center space-y-2">

<?php
// If we still have more results, show a "Load more" button
?>
<button class="button-primary">More results</button>

<span class="text-slate">[x-100] of <?= number_format($resultcount); ?> results.</span>

<a class="link" href="<?= esc($exporturl) ?>" rel=“nofollow”>Download full results.</a>
</footer>
