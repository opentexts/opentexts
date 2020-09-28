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
