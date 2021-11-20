<?php
/** @var array $code */
/** @var array $name */

isset($_GET['genre']) ? $genre = $_GET['genre'] : $genre = '';

?>

<li class="sidebar-item <?= $genre === $code ? 'sidebar-item--active' : ''?>"><a href="index.php?genre=<?= $code ?>"><?= $name ?></a></li>