<main role="main" class="container main-container">
    <article class="mx-auto max-w-xl">
        <p>
            No results found for <em class="font-semibold not-italic"><?= esc($q); ?></em>.
        </p>
        <?php if ($advanced === True) { ?>
            <p><a href="/advanced?<?= esc(substr($url, 9)) ?>">Edit search</a></p>
        <?php } ?>
        <p>
            Suggestions:
        </p>
        <ul>
            <li>Make sure all words are spelled correctly.</li>
            <li>Try different keywords.</li>
            <li>Try more general keywords.</li>
            <li>Try fewer keywords.</li>
        </ul> 
    </article>
</main>
