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
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>OpenTexts.world: <?= esc($title); ?></title>
        <meta name="description" content="Search, discover, and download open digitised texts and books">
        <link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
        <link rel="stylesheet" href="/css/app.css">
        <?php if (getenv('CI_ENVIRONMENT') !== 'production'): ?>
          <script src="//localhost:35729/livereload.js"></script>
        <?php endif; ?>
        <script src="./scripts/analytics.js"></script>
</head>

<body class=" mx-auto bg-blue-900">
