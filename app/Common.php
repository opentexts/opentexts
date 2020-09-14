<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the frameworks
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @link: https://codeigniter4.github.io/CodeIgniter4/
 */

// Outputs a navigation link for use in a menu. Currently used by both footer and header menus.
function renderNavLink(string $path, string $name, string $current_path) {
    $active = $path == $current_path;
    ?>
        <li>
            <a href="<?= $path ?>" class="block <?= $active ? "navigation-link-current" : "navigation-link" ?>"><?= $name ?></a>
        </li>
    <?php
}

// Get a reference for the current page.
function getCurrentPage() {
    $uri = current_url(true);
    $current_path = "/" . $uri->getSegment(1);
    return $current_path;
}
