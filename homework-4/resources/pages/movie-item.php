<?php
foreach ($movies as $movie)
{
	echo renderTemplate("./resources/blocks/_movie-item.php", ['movie' => $movie]);
}

