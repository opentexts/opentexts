<header role="header" class="mx-auto max-w-3xl flex justify-center items-center py-6 space-x-6">

  <a href="/home"><img class="w-16" src="/images/logo.svg" alt="Open Texts" /></a>

  <?php include('search-form.php'); ?>
    
    <a class="flex flex-col justify-center items-center text-gray-100 no-underline" id="nav-toggle">
        <span class="text-opacity-50"><?php echo file_get_contents('svg/menu.svg'); ?></span>
        <span class="text-sm">Menu</span>
    </a>
</header>

<header role="header" class="flex items-center space-x-6 hidden" id="nav-content">
    <div class="w-full flex-grow ">
            <ul class="list-reset lg:flex flex-1 justify-center">
                    <li class="mr-3">
                            <a class="inline-block  px-4 text-white no-underline" href="/">Home</a>
                    </li>
                    <li class="mr-3">
                            <a class="inline-block text-gray-600 no-underline hover:text-gray-200 hover:text-underline  px-4" href="/help">Help</a>
                    </li>
                    <li class="mr-3">
                            <a class="inline-block text-gray-600 no-underline hover:text-gray-200 hover:text-underline px-4" href="/about">About</a>
                    </li>
                    <li class="mr-3">
                            <a class="inline-block text-gray-600 no-underline hover:text-gray-200 hover:text-underline px-4" href="/contribute">Contribute</a>
                    </li>
            </ul>
    </div>
</header>

<script>
    //Javascript to toggle the menu
    document.getElementById('nav-toggle').onclick = function(){
            document.getElementById("nav-content").classList.toggle("hidden");
    }
</script>
