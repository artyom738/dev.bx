<?php

/** @var array $genres */

/** @var array $config */

$currentPage = basename($_SERVER['SCRIPT_FILENAME']);

$sidebarGenres = renderTemplate('./resources/blocks/_sidebar-menu.php',
	[
		'genres' => $genres,
		'config' => $config,
		'currentPage' => $currentPage
	]);