<nav class="container mx-auto pt-8 px-4">
    <ul class="flex justify-center space-x-2 sm:space-x-8">
        <?php

        $uri = current_url(true);
        $current_path = "/" . $uri->getSegment(1);
        function renderNavLink(string $path, string $name, string $current_path)
        {
            $active = $path == $current_path;
            ?>
            <li>
                <a href="<?= $path ?>" class="block <?= $active ? "navigation-link-current" : "navigation-link" ?>"><?= $name ?></a>
            </li>
            <?php
        }

        renderNavLink("/", "Home", $current_path);
        renderNavLink("/about", "About", $current_path);
        renderNavLink("/contribute", "Contribute", $current_path);
        renderNavLink("/help", "Help", $current_path);
        ?>
    </ul>
</nav>
