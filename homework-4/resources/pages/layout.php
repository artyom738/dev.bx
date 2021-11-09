<?php

/** @var array $content */
/** @var array $config */
/** @var array $sidebarGenres */

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= $config['title'] ?></title>
	<link rel="stylesheet" href="resources/css/reset.css">
	<link rel="stylesheet" href="resources/css/main.css">
</head>
<body>
<div class="wrapper">
	<div class="sidebar">
		<div class="logo"><a href="index.php"><img src="./img/logo.png" alt="Bitflix Logo"></a></div>
		<div class="sidebar-list-container">
			<ul class="sidebar-list">
				<?= $sidebarGenres ?>
			</ul>
		</div>

	</div>
	<div class="container">
		<div class="header">
			<form action="index.php" method="get">
				<div class="header-search-container">
					<div class="header-search-icon" style="background-image: url('./img/search.png')"></div>
					<input type="text" name="query" placeholder="Поиск по каталогу..." class="header-search-field">
				</div>

					<button class="header-search-button" type="submit" value="search">Искать</button>
			</form>
			<div class="header-addfilm">
				<a href="add-film.php">Добавить фильм</a>
			</div>

		</div>
		<div class="content">
			<?= $content ?>
		</div>
	</div>
</div>

</body>
</html>