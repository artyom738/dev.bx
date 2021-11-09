<?php
/** @var array $movies */
/** @var array $genres */

require_once './lib/helper-functions.php';

function FilterMovies(string $code, array $movies, array $genres): string
{
	$result = '';
	foreach ($movies as $movie)
	{
		if (isset($genres[$code]) && in_array($genres[$code], $movie['genres'], true))
		{
			$result .= renderTemplate("./resources/blocks/_movie-item.php", ['movie' => $movie]);
		}
	}
	return $result;
}

function searchMovie(string $query, array $movies): string
{
	$result = '';
	foreach ($movies as $movie)
	{
		if (str_contains($movie['title'], $_GET['query']))
		{
			$result .= renderTemplate("./resources/blocks/_movie-item.php", ['movie' => $movie]);
		}
	}
	if (!$result)
	{
		$result = renderTemplate('./resources/pages/no-search-results.php');
	}
	return $result;
}


if (isset($_GET['genre']))
{
	$movieItem = FilterMovies($_GET['genre'], $movies, $genres);
}
elseif (isset($_GET['query']) && $_GET['query'] !== '')
{
	$movieItem = searchMovie($_GET['query'], $movies);
}
else
{
	$movieItem = renderTemplate('./resources/pages/movie-item.php', ['movies' => $movies]);
}