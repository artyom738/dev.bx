<?php

/** @var array $movie */

?>
<link rel="stylesheet" href="./resources/css/movie-page.css">
<div class="movie-wrapper">
	<div class="movie-header">
		<div class="movie-header-title-row">
			<div class="movie-header-title"><?= $movie['title'] ?> (<?= $movie['release-date'] ?>)</div>
			<div class="movie-header-bookmark movie-header-bookmark-active"></div>
		</div>
		<div class="movie-header-subtitle-row">
			<div class="movie-header-subtitle"><?= $movie['original-title'] ?></div>
			<div class="movie-header-subtitle-restriction"><?= $movie['age-restriction'] ?>+</div>
		</div>

	</div>
	<div class="movie-content">
		<div class="movie-content-img-bg">
			<div class="movie-content-img" style="background-image: url(img/<?= $movie['id'] ?>.jpg)"></div>
		</div>
		<div class="movie-content-info">
			<div class="movie-content-info-rating">
				<?= renderTemplate('./resources/blocks/_movie-rating.php', ['rating' => $movie['rating'] ]) ?>
			</div>
			<div class="movie-content-info-about">
				<div class="movie-content-info-about-title">
					О фильме
				</div>
				<table class="movie-content-info-about-table">
					<tr>
						<td>Год производства:</td>
						<td><?= $movie['release-date'] ?></td>
					</tr>
					<tr>
						<td>Режиссер:</td>
						<td><?= $movie['director'] ?></td>
					</tr>
					<tr>
						<td>В главных ролях:</td>
						<td><?= implode(', ', $movie['cast']) ?></td>
					</tr>
				</table>
			</div>
			<div class="movie-content-info-descripion">
				<div class="movie-content-info-about-title">
					Описание
				</div>
				<div class="movie-content-info-descripion-text"><?= $movie['description'] ?></div>
			</div>
		</div>
	</div>
</div>