<footer role="footer" class="container mx-auto py-8 flex flex-col items-center justify-center space-y-2">

<?php
if(!$lastpage)
{
?>
    <form method="get">
        <input type="hidden" name="q" value="<?= $q ?>" />
        <input type="hidden" name="start" value="<?= ($start+$count) ?>" />
        <button type="submit" class="py-3 px-10 rounded-md bg-cobalt text-offWhite">More results</button>
    </form>
<?php
}
?>
<span class="text-slate">[<?= number_format($start+1) . '-' . ($lastpage ? $resultcount : number_format($start+$count)) ?>] of <?= number_format($resultcount); ?> results.</span>

<a class="text-darkCyan underline" href="<?= esc($exporturl) ?>" rel=“nofollow”>Download full results.</a>
</footer>
