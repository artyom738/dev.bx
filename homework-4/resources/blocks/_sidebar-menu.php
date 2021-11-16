<?php
/** @var array $genres */
/** @var array $config */
/** @var string $currentPage */

?>
<li class="sidebar-item <?= ($currentPage === 'index.php' && !isset($_GET['genre'])) ? 'sidebar-item--active' : ''?>"><a href="index.php"><?= $config['menu']['index'] ?></a></li>

<?php foreach ($genres as $genreEng => $genreRu): ?>
	<?= renderTemplate("./resources/blocks/_sidebar-menu-item.php", ['genreRu' => $genreRu, 'genreEng' => $genreEng]) ?>
<?php endforeach; ?>

<li class="sidebar-item <?= $currentPage === 'bookmark.php' ? 'sidebar-item--active' : ''?>"><a href="bookmark.php"><?= $config['menu']['bookmark'] ?></a></li>