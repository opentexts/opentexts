<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>OpenTexts.world: <?= esc($title); ?></title>
	<meta name="description" content="Search, discover, and download open digitised texts and books">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
	<link rel="stylesheet" href="/css/otw-base.css">
</head>
<body>

<!-- HEADER: MENU + HERO SECTION -->
<header>

    <div class="menu">
        <ul>
                <li class="logo"><a href="/" target="_blank">
                        <!--<img height="44" 
                             title="OpenTexts.World Logo"
                             alt="Visit CodeIgniter.com official website!"
                             src="/images/otw-logo.jpg">-->
                    </a>
                </li>
                <li class="menu-toggle">
                    <button onclick="toggleMenu();">&#9776;</button>
                </li>
                <li class="menu-item hidden"><a href="/">Home</a></li>
                <li class="menu-item hidden"><a href="/support/">Support</a></li>
                <li class="menu-item hidden"><a href="/sources/">Sources</a></li>
                <li class="menu-item hidden"><a href="/contribute/">Contribute</a>
                </li>
        </ul>
    </div>

    <div class="hero">
        <h1>OpenTexts.World</h1>
        <h2>Opening up a world of digitised texts</h2>
    </div>
</header>