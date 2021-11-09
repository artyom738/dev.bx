<?php
declare(strict_types=1);

/** @var array $movies */
/** @var array $config */
/** @var array $pageName */

require_once './lib/template-functions.php';
require_once "./data/movies.php";
require_once "./lib/pagename.php";
require_once "./config/app.php";
require_once "./resources/pages/sidebar-menu.php";

$content = renderTemplate('./resources/pages/in-progress-page.php');

renderLayout($content, [
	'config' => $config,
	'sidebarGenres' => $sidebarGenres,
]);