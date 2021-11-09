<?php
/** @var array $movies */
?>

<?php foreach ($movies as $movie): ?>
	<?= renderTemplate("./resources/blocks/_movie-item.php", ['movie' => $movie]) ?>
<?php endforeach; ?>
