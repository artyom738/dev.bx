<?php
declare(strict_types = 1);

/** @var array $config */
/** @var mysqli $database */
/** @var array $settings */

require_once './lib/template-functions.php';
require_once './lib/movie-filtering.php';
require_once "./lib/pagename.php";
require_once "./config/app.php";
require_once "./config/db.php";
require_once './lib/movie-filtering.php';

$database = connectDatabase($database, $settings);

$genres = getGenres($database);

isset($_GET['id']) ? $num = (int)$_GET['id'] : $num = 0;

$movie = getMovie($database, $num);

$sidebarGenres = renderTemplate('./resources/blocks/_sidebar-menu.php',
	[
		'genres' => $genres,
		'config' => $config,
	]);

$content = renderTemplate('./resources/pages/movie-page.php', ['movie' => $movie[0]]);

$pagename = $movie[0]['TITLE'];

renderLayout($content, [
	'config' => $config,
	'pagename' => $pagename,
	'sidebarGenres' => $sidebarGenres,
]);
