<main role="main" class="container main-container pt-6">

    <h1 class="sr-only">Search results for <?php echo(esc($q)); ?></h2>
            
    <?php
        if ($resultcount == 0) {
            include('templates/no-results.php');
        } else {
            include('templates/search-results.php');
        }
    ?>

</main>
