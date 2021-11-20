<?php

require_once 'app.php';

$settings = $config['db'];

$database = mysqli_init();

function connectDatabase($database, array $settings): mysqli
{
	$connectionResult = mysqli_real_connect(
		$database,
		$settings['host'],
		$settings['username'],
		$settings['password'],
		$settings['dbName']
	);

	if(!$connectionResult)
	{
		$error = 'Ошибка подключения к базе данных. ' . mysqli_connect_errno($database) . ': ' . mysqli_connect_error($database);
		trigger_error($error, E_USER_ERROR);
	}

	$charsetResult = mysqli_set_charset($database,'utf8');

	if(!$charsetResult)
	{
		$error = 'Ошибка установки кодировки. ' . mysqli_connect_errno($database) . ': ' . mysqli_connect_error($database);
		trigger_error($error, E_USER_ERROR);
	}

	return $database;
}



