<?php
declare(strict_types = 1);

/** @var array $config */
/** @var mysqli $database */
/** @var array $settings */

require_once './lib/template-functions.php';
require_once "./lib/pagename.php";
require_once "config/app.php";
require_once "config/db.php";
require_once './lib/movie-filtering.php';

$database = connectDatabase($database, $settings);

$genres = getGenres($database);

if (isset($_GET['genre']))
{
	$movies = getMovies($database, $_GET['genre']);
	$pagename = ucwords($_GET['genre']);
	$movieItem = renderTemplate('./resources/pages/movie-item.php', ['movies' => $movies]);
}
elseif (isset($_GET['query']) && $_GET['query'] !== '')
{
	$pagename = 'Поиск по запросу: ' . $_GET['query'];

	$moviesForQuery = searchMovie($database, $_GET['query']);
	if (empty($moviesForQuery))
	{
		$movieItem = renderTemplate('./resources/pages/no-search-results.php');
	}
	else
	{
		$movieItem = renderTemplate('./resources/pages/movie-item.php', ['movies' => $moviesForQuery]);
	}
}
else
{
	$pagename = $config['menu']['index'];
	$movies = getMovies($database);
	$movieItem = renderTemplate('./resources/pages/movie-item.php', ['movies' => $movies]);
}

$currentPage = basename($_SERVER['SCRIPT_FILENAME']);

$sidebarGenres = renderTemplate('./resources/blocks/_sidebar-menu.php',
	[
		'genres' => $genres,
		'config' => $config,
		'currentPage' => $currentPage,
	]);

renderLayout($movieItem, [
	'config' => $config,
	'pagename' => $pagename,
	'sidebarGenres' => $sidebarGenres,
]);

