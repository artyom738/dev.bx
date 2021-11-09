<?php
declare(strict_types=1);

/** @var string $movieItem */
/** @var array $config */
/** @var array $sidebarGenres */

require_once './lib/template-functions.php';
require_once "./data/movies.php";
require_once "./lib/pagename.php";
require_once "./config/app.php";
require_once "./resources/pages/sidebar-menu.php";
require_once './lib/genre-filtering.php';


renderLayout($movieItem, [
	'config' => $config,
	'sidebarGenres' => $sidebarGenres,
]);