<?php
/** @var array $genreEng */
/** @var array $genreRu */
?>

<li class="sidebar-item <?= $_GET['genre'] === $genreEng ? 'sidebar-item--active' : ''?>"><a href="index.php?genre=<?= $genreEng ?>"><?= $genreRu ?></a></li>


