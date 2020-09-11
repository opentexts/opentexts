<nav class="container mx-auto pt-8 navigation-primary">
    <ul class="flex justify-center space-x-8">
        <?php
            $uri = current_url(true);
            $current_path = "/" . $uri->getSegment(1);

            renderNavLink("/", "Home", $current_path);
            renderNavLink("/about", "About", $current_path);
            renderNavLink("/contribute", "Get Involved", $current_path);
            renderNavLink("/help", "Help", $current_path);
        ?>
    </ul>
</nav>
