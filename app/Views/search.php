<main role="main" class="container main-container">

    <h1 class="sr-only">Search results for <?php echo(esc($q)); ?></h2>
            
    <?php
        if ($resultcount == 0) {
            include('templates/no-results.php');
        } else {
            include('templates/search-results.php');
        }
    ?>

</main>
