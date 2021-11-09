<?php
for ($i=1; $i<=10; $i++)
{
	if (floor($rating) >= $i)
		{
			echo '<div class="movie-content-info-rating-rectangle"></div>';
		}
	else
	{
		echo '<div class="movie-content-info-rating-rectangle nonactive"></div>';
	}
}

?>

<div class="movie-content-info-rating-circle"><?= $rating ?></div>
