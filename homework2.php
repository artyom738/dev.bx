<?php
require "movies (1).php";
$userAge = readline("Input your age: ");
$allowedMovies = [];

foreach ($movies as $movie) {
	if ($userAge > $movie["age_restriction"]) {
		$allowedMovies[] = $movie;
	}
}

$i = 1;
foreach ($allowedMovies as $movie) {
	echo "$i. $movie[title] ($movie[release_year]), $movie[age_restriction]+. Rating - $movie[rating]";
	echo "\n";
	$i++;
}
