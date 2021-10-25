<?php
require "movies (1).php";
$userAge = readline("Input your age: ");

if (is_numeric($userAge))
{
	showAllowedMovies($movies, $userAge);
}
else
{
	echo "Age is incorrect.";
}

function showAllowedMovies($movies, $userAge)
 {
	 $i = 1;
	 foreach ($movies as $movie)
	 {
		 if ((int) $userAge >= $movie["age_restriction"])
		 {
			 echo "$i. $movie[title] ($movie[release_year]), $movie[age_restriction]+. Rating - $movie[rating]";
			 echo "\n";
			 $i++;
		 }
	 }
 }

