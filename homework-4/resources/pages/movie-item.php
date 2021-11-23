<?php
foreach ($movies as $movie)
{
	$movieGenres = getGenresByListId($genres, $movie['genres']);
	echo renderTemplate("./resources/blocks/_movie-item.php", ['movie' => $movie, 'movieGenres' => $movieGenres]);
}
