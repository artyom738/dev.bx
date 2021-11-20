<?php
/** @var array $movies */
/** @var array $genres */

require_once 'helper-functions.php';
// echo pathinfo();
require_once "./config/db.php";

function getGenres(mysqli $database): array
{
	$query = 'SELECT ID, CODE, NAME FROM genre';
	$result = mysqli_query($database, $query);
	$out = [];
	while ($row = mysqli_fetch_assoc($result))
	{
		$out[(string)$row['ID']] = ['CODE' => $row['CODE'], 'NAME' => $row['NAME']];
	}
	return $out;
}

function getMovies(mysqli $database, string $code = ''): array
{
	$code = htmlspecialchars($code);

	$query = 'SELECT m.ID, m.TITLE, m.ORIGINAL_TITLE, m.DESCRIPTION, m.DURATION, m.RELEASE_DATE, genreName.genres
FROM movie m
	     LEFT JOIN movie_genre mg on m.ID = mg.MOVIE_ID
	     LEFT JOIN genre g on mg.GENRE_ID = g.ID
LEFT JOIN
(SELECT group_concat(g.NAME) genres, m.ID as MOVIE_ID
FROM movie m
	     LEFT JOIN movie_genre mg on m.ID = mg.MOVIE_ID
	     LEFT JOIN genre g on mg.GENRE_ID = g.ID
GROUP BY TITLE) genreName on genreName.MOVIE_ID = m.ID';

	if ($code !== '')
	{
		$query .= " WHERE g.CODE = '{$code}'";
	}
	$query .= ' GROUP BY 1';

	$resultDB = mysqli_query($database, $query);

	if (!$resultDB)
	{
		trigger_error('Error query completing');
	}
	$out = [];

	while ($row = mysqli_fetch_assoc($resultDB))
	{
		$out[] = $row;
	}

	return $out;
}

function getMovie(mysqli $database, int $id): array
{
	// $id = htmlspecialchars($id);

	$query = "SELECT m.ID, m.TITLE, m.ORIGINAL_TITLE, m.DESCRIPTION, m.DURATION, m.RELEASE_DATE, m.RATING, M.AGE_RESTRICTION, genreName.genres, d.NAME DIRECTOR_NAME, actors
FROM movie m
	     LEFT JOIN movie_genre mg on m.ID = mg.MOVIE_ID
	     LEFT JOIN genre g on mg.GENRE_ID = g.ID
LEFT JOIN
(SELECT group_concat(g.NAME SEPARATOR ', ') genres, m.ID as MOVIE_ID
FROM movie m
	     LEFT JOIN movie_genre mg on m.ID = mg.MOVIE_ID
	     LEFT JOIN genre g on mg.GENRE_ID = g.ID
GROUP BY TITLE) genreName on genreName.MOVIE_ID = m.ID
LEFT JOIN director d on d.ID = m.DIRECTOR_ID

LEFT JOIN
     (SELECT group_concat(a.NAME SEPARATOR ', ') actors, m.ID as MOVIE_ID
      FROM movie m
	           LEFT OUTER JOIN movie_actor ma on m.ID = ma.MOVIE_ID
	           LEFT JOIN actor a on a.ID = ma.ACTOR_ID
      GROUP BY TITLE) actors on actors.MOVIE_ID = m.ID WHERE m.ID = '{$id}' GROUP BY 1";

	$resultDB = mysqli_query($database, $query);

	if (!$resultDB)
	{
		trigger_error('Error query completing');
	}
	$out = [];

	while ($row = mysqli_fetch_assoc($resultDB))
	{
		$out[] = $row;
	}

	return $out;
}

function searchMovie(mysqli $database, string $searchQuery): array
{
	$searchQuery = htmlspecialchars($searchQuery);

	$query = "SELECT m.ID, m.TITLE, m.ORIGINAL_TITLE, m.DESCRIPTION, m.DURATION, m.RELEASE_DATE, genreName.genres
FROM movie m
	     LEFT JOIN movie_genre mg on m.ID = mg.MOVIE_ID
	     LEFT JOIN genre g on mg.GENRE_ID = g.ID
	     LEFT JOIN
     (SELECT group_concat(g.NAME) genres, m.ID as MOVIE_ID
      FROM movie m
	           LEFT JOIN movie_genre mg on m.ID = mg.MOVIE_ID
	           LEFT JOIN genre g on mg.GENRE_ID = g.ID
      GROUP BY TITLE) genreName on genreName.MOVIE_ID = m.ID
WHERE m.TITLE LIKE '%{$searchQuery}%'
GROUP BY 1";

	$resultDB = mysqli_query($database, $query);

	if (!$resultDB)
	{
		trigger_error('Error query completing');
	}
	$out = [];

	while ($row = mysqli_fetch_assoc($resultDB))
	{
		$out[] = $row;
	}
	renderTemplate('./resources/pages/no-search-results.php');
	return $out;
}

