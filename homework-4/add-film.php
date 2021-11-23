<?php
declare(strict_types=1);

/** @var array $genres */
/** @var array $movies */
/** @var array $config */
/** @var array $pageName */

require_once './lib/template-functions.php';
require_once "./config/app.php";
require_once "config/db.php";
require_once './lib/movie-filtering.php';

$database = connectDatabase($database, $settings);

$genres = getGenres($database);

$content = renderTemplate('./resources/pages/in-progress-page.php');

$currentPage = basename($_SERVER['SCRIPT_FILENAME']);

$sidebarGenres = renderTemplate('./resources/blocks/_sidebar-menu.php',
	[
		'genres' => $genres,
		'config' => $config,
		'currentPage' => $currentPage
	]);

renderLayout($content, [
	'config' => $config,
	'pagename' => $config['menu']['addfilm'],
	'sidebarGenres' => $sidebarGenres,
]);
