<header class="mx-auto max-w-3xl flex justify-center items-center py-4 px-4 xs:space-x-2 sm:py-6 sm:space-x-6">
    <a href="/" class="rounded-sm p-2 -m-2">
        <canvas class="hidden xs:block" height="94" width="94" id="logo" style="height: 52px;"  role="img" aria-label="Open Texts"></canvas>
    </a>

    <h1 class="text-white"><?= $title ?></h1>
    
    <a id="navigation-toggle" tabindex="0" class="flex ml-2 xs:ml-0 flex-col justify-center items-center text-gray-100 no-underline cursor-pointer hover:text-blue-200 rounded-sm p-2 -m-2">
        <span aria-hidden="true" class="text-opacity-50"><?php echo file_get_contents('svg/menu.svg'); ?></span>
        <span class="text-xs sm:text-sm">Menu</span>
    </a>
  
    <?php include('navigation-modal.php'); ?>

</header>
