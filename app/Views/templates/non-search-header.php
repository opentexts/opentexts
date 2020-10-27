<header class="mx-auto max-w-3xl flex justify-center items-center py-4 px-4 xs:space-x-2 sm:py-6 sm:space-x-6">
    <a href="/" class="rounded-sm p-2 -m-2">
        <canvas class="hidden xs:block" height="94" width="94" id="logo" style="height: 52px;"  role="img" aria-label="Open Texts"></canvas>
    </a>

    <nav class="container mx-auto pt-8 px-4 navigation-primary">
        <ul class="flex justify-center space-x-2 sm:space-x-8">
            <?php
                $current_path = getCurrentPage();
                renderNavLink("/", "Home", $current_path);
                renderNavLink("/about", "About", $current_path);
                renderNavLink("/contribute", "Contribute", $current_path);
                renderNavLink("/help", "Help", $current_path);
            ?>
        </ul>
    </nav>

    <?php include('navigation-modal.php'); ?>

</header>
