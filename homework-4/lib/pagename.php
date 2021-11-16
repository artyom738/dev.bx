<?php
require_once './data/pages.php';
require_once './data/movies.php';

$scriptName = basename($_SERVER['SCRIPT_FILENAME'], '.php');

$pageName = $pages[$scriptName];

if (isset($_GET['genre']))
{
	$pageName = $genres[$_GET['genre']];
}

if (isset($_GET['id']) && $scriptName === 'movie')
{
	$pageName = $movies[(int) $_GET['id']-1]['title'];
	$movieID = (int) $_GET['id'];
}