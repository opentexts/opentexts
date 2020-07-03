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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/otw-base.css">
</head>

<body>

    <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark justify-content-between">
      <a class="navbar-brand" href="/">OpenTexts.World</a>

      <form action="search" method="GET" class="form-inline">
        <div class="input-group justify-content-center">
            <input type="text" class="form-control" name="q" value="<?= $q; ?>" /> 
            &nbsp;<button type=button" class="btn btn-outline-light">Search</button>
        </div>
      </form>  
      
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarright" aria-controls="navbarright" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse" id="navbarsright">
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
