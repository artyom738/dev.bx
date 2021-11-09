<?php

/** @var array $genres */

/** @var array $config */

$sidebarGenres = renderTemplate('./resources/blocks/_sidebar-menu.php', ['genres' => $genres, 'config' => $config]);