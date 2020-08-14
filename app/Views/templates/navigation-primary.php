
<nav class="container mx-auto pt-8">
    <ul class="flex justify-center space-x-8">
        <?php

        $uri = current_url(true);
        $current_path = "/" . $uri->getSegment(1);
        function renderNavLink(string $path, string $name, string $current_path)
        {
            $active = $path == $current_path;
            ?>
            <li>
                <a href="<?= $path ?>" class="block <?= $active ? "border-b-2 border-cyan p-2 text-cyan" : "text-offWhite p-2" ?>"><?= $name ?></a>
            </li>
            <?php
        }

        renderNavLink("/", "Home", $current_path);
        renderNavLink("/about", "About", $current_path);
        renderNavLink("/contribute", "Get Involved", $current_path);
        renderNavLink("/support", "Help", $current_path);
        ?>
    </ul>
</nav>
