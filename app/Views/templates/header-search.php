<!doctype html>
<html lang="en">
    <head>
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-171145480-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
          gtag('config', 'UA-171145480-1');
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
</head>

<body>

    <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark justify-content-between">
      <a class="navbar-brand" href="/">OpenTexts.World</a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarright" aria-controls="navbarright" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <form action="search" method="GET" class="form-inline">
        <div class="input-group justify-content-center">
            <input type="text" class="form-control" size="50" name="q" value="<?= esc($q); ?>" />
            &nbsp;<button type=button" class="btn btn-outline-light">Search</button>
        </div>
      </form>

      <div class="collapse navbar-collapse" id="navbarright">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/home">Home</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="/sources">Sources</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="/contribute">Contribute</a>
          </li>
        </ul>
      </div>
    </nav>
