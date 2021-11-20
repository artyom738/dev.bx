<?php
/** @var array $genres */
/** @var array $config */
/** @var string $currentPage */


?>

<li class="sidebar-item <?= ($currentPage === 'index.php' && !isset($_GET['genre'])) ? 'sidebar-item--active' : ''?>"><a href="index.php"><?= $config['menu']['index'] ?></a></li>

<?php
	foreach ($genres as $id => $data)
	{
		echo renderTemplate("./resources/blocks/_sidebar-menu-item.php", ['name' => $data['NAME'], 'code' => $data['CODE']]);
	}
?>

<li class="sidebar-item <?= $currentPage === 'bookmark.php' ? 'sidebar-item--active' : ''?>"><a href="bookmark.php"><?= $config['menu']['bookmark'] ?></a></li>