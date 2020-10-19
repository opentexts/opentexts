<main role="main" class="container main-container pt-6">

    <?php
        if ($advanced) { ?>
            <div><a href="/advanced?<?= substr($url, 9) ?>">Edit search</a></div>
        <?php }
    ?>
    
    <h1 class="sr-only">Search results for <?php echo(esc($q)); ?></h2>
            
    <?php
        if ($resultcount == 0) {
            include('templates/no-results.php');
        } else {
            include('templates/search-results.php');
        }
    ?>

</main>
