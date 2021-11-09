<?php
/** @var array $movie */

$movieID = $movie['id'];

$movieTitle = mb_strimwidth($movie['title'], 0, 18, '...');

$movieOriginalTitle = mb_strimwidth($movie['original-title'], 0, 47, '...');

$movieDescription = mb_strimwidth($movie['description'], 0, 190, '...');

$duration = $movie['duration'];

$durationHoursMins = '0' . intdiv($duration, 60) . ':' . ($duration % 60);

$movieGenres = implode(', ', array_slice($movie['genres'], 0, 3));

?>



<div class="movie-list-item">
	<div class="movie-list-item-overlay">
		<a href="./movie.php?id=<?= $movieID ?>" class="movie-list-item-overlay-link">ПОДРОБНЕЕ</a>
	</div>
	<div class="movie-list-item-img" style="background-image: url(img/<?=$movie['id']?>.jpg)"></div>
	<div class="movie-list-item-title"><?= $movieTitle ?> (<?=$movie['release-date']?>)</div>
	<div class="movie-list-item-subtitle"><?= $movieOriginalTitle ?></div>
	<div class="movie-list-item-separator"></div>
	<div class="movie-list-item-description"><?= $movieDescription ?></div>
	<div class="movie-list-item-bottom">
		<div class="movie-list-item-time">
			<div class="movie-list-item-clock" style="background-image: url(img/clock1.svg)"></div>
			<div class="movie-list-item-duration"><?=$duration?> мин. / <?= $durationHoursMins ?></div>
		</div>
		<div class="movie-list-item-genre">
			<?= $movieGenres ?>
		</div>
	</div>

</div>