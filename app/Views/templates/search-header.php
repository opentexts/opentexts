<header class="mx-auto max-w-3xl flex justify-center items-center py-4 px-4 xs:space-x-2 sm:py-6 sm:space-x-6">
  <a href="/" class="rounded-sm p-2 -m-2"><img class="hidden xs:block w-12 sm:w-16" src="/images/logo.svg" alt="Open Texts" /></a>

  <?php include('search-form.php'); ?>
    
    <a id="navigation-toggle" tabindex="0" class="flex ml-2 xs:ml-0 flex-col justify-center items-center text-gray-100 no-underline cursor-pointer hover:text-blue-200 rounded-sm p-2 -m-2">
        <span aria-hidden="true" class="text-opacity-50"><?php echo file_get_contents('svg/menu.svg'); ?></span>
        <span class="text-xs sm:text-sm">Menu</span>
    </a>
  
    <?php include('navigation-modal.php'); ?>

</header>
