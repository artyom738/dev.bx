<?php
/** @var array $movies */
/** @var array $genres */

require_once './lib/helper-functions.php';

function filterMovies(string $code, array $movies, array $genres): string
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
		if (str_contains($movie['title'], $query))
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
