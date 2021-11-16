<?php
declare(strict_types=1);

/** @var string $movieItem */
/** @var array $config */
/** @var array $sidebarGenres */
/** @var array $movies */
/** @var array $genres */

require_once './lib/template-functions.php';
require_once "./data/movies.php";
require_once "./lib/pagename.php";
require_once "./config/app.php";
require_once "./resources/pages/sidebar-menu.php";
require_once './lib/genre-filtering.php';

if (isset($_GET['genre']))
{
	$movieItem = filterMovies($_GET['genre'], $movies, $genres);
}
elseif (isset($_GET['query']) && $_GET['query'] !== '')
{
	$movieItem = searchMovie($_GET['query'], $movies);
}
else
{
	$movieItem = renderTemplate('./resources/pages/movie-item.php', ['movies' => $movies]);
}

renderLayout($movieItem, [
	'config' => $config,
	'sidebarGenres' => $sidebarGenres,
]);