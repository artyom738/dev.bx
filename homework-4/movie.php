<?php
declare(strict_types=1);

/** @var array $movies */
/** @var array $config */
/** @var array $sidebarGenres */

require_once './lib/template-functions.php';
require_once "./data/movies.php";
require_once "./lib/pagename.php";
require_once "./config/app.php";
require_once "./resources/pages/sidebar-menu.php";

$num = $_GET['id'];

$content = renderTemplate('./resources/pages/movie-page.php', ['movie' => $movies[$num-1]]);

renderLayout($content, [
	'config' => $config,
	'sidebarGenres' => $sidebarGenres,
]);
