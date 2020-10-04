<!doctype html>
<html lang="en">
    <head>
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-171145480-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
          gtag('config', 'UA-171145480-1', { 'anonymize_ip': true });
        </script>
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-NHHK56R');</script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>OpenTexts.world: <?= esc($title); ?></title>
        <meta name="description" content="Search, discover, and download digitised texts and books.">

        <!-- OG Tags -->
        <meta property="og:title" content="<?= esc($title); ?>" />
        <meta property="og:url" content="<?php echo current_url(true); ?>" />
        <meta property="og:image" content="https://opentexts.world/og-image.png" />
        <meta property="og:type" content="website" />
        <meta property="og:description" content="A search engine for books. OpenTexts provides free access to digitised text collections from around the world." />
        <meta property="og:locale" content="en_GB" />

        <link rel="icon" type="image/png" href="/favicon.png"  />
        <link rel="stylesheet" href="/css/app.css">
        <?php if (getenv('CI_ENVIRONMENT') !== 'production'): ?>
          <script src="//localhost:35729/livereload.js"></script>
        <?php endif; ?>
        <script src="./scripts/event-recording.js"></script>
        
        <?php if ($title == 'Search'): ?>
            <link rel="preload" href="/scripts/SearchResults/Models/query.js" as="script">
            <link rel="preload" href="/scripts/SearchResults/ViewControllers/filter-view-controller.js" as="script">
        <?php endif; ?>
    </head>

<body class=" mx-auto bg-blue-900">
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NHHK56R"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
